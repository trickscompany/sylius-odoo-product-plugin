<?php

/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Fab IT Sylius Odoo Product Sync Plugin to newer
 * versions in the future.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://www.fabitsolutions.in/ and write us
 * an email on contact@fabitsolutions.in
 *
 * @category  Fabitsolutions
 * @package   fabit/sylius-odoo-product-plugin
 * @author    contact@fabitsolutions.in
 * @copyright 2023 Fab IT Solutions
 * @license   Open Software License ("OSL") v. 3.0
 */

declare(strict_types=1);

namespace Fabit\SyliusOdooProductPlugin\Resolver;

use Fabit\SyliusOdooProductPlugin\Model\ProductAttribute;
use Gedmo\Sluggable\Util\Urlizer;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Product\Model\ProductAttributeValueInterface;
use Sylius\Component\Product\Repository\ProductAttributeValueRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class ProductAttributeValueResolver implements ProductAttributeValueResolverInterface
{
    /** @var ProductAttributeValueRepositoryInterface */
    private $productAttributeValueRepository;

    /** @var FactoryInterface */
    private $productAttributeValueFactory;

    public function __construct(
        ProductAttributeValueRepositoryInterface $productAttributeValueRepository,
        FactoryInterface $productAttributeValueFactory
    ) {
        $this->productAttributeValueRepository = $productAttributeValueRepository;
        $this->productAttributeValueFactory = $productAttributeValueFactory;
    }

    public function resolve(
        ProductInterface $syliusProduct,
        ProductAttribute $productAttribute,
        ProductAttributeInterface $syliusAttribute,
        string $locale
    ): ?ProductAttributeValueInterface {
        $sanitisedValue =
            isset($productAttribute->value) && $productAttribute->value !== ''
                ? $this->sanitizeOdooValue($productAttribute->value, $productAttribute->type, $locale) : null;

        $productAttributeValue = $this->loadProductAttributeValue($syliusProduct, $syliusAttribute);
        if (!$this->isValueNotEmpty($sanitisedValue)) {
            $sanitisedValue = null;
        }

        $productAttributeValue->setProduct($syliusProduct);
        $productAttributeValue->setAttribute($syliusAttribute);
        $productAttributeValue->setLocaleCode($locale);
        $productAttributeValue->setValue($sanitisedValue);

        return $productAttributeValue;
    }

    /**
     * @param mixed $sanitisedValue
     */
    private function isValueNotEmpty($sanitisedValue): bool
    {
        return (is_array($sanitisedValue) && !empty($sanitisedValue)) ||
            (!is_array($sanitisedValue) && ($sanitisedValue !== false));
    }

    private function loadProductAttributeValue(ProductInterface $syliusProduct, ProductAttributeInterface $syliusAttribute): ProductAttributeValueInterface
    {
        if ($syliusProduct->getId() === null) {
            /** @var ProductAttributeValueInterface $value */
            $value = $this->productAttributeValueFactory->createNew();

            return $value;
        }
        $attributeValue = $this->productAttributeValueRepository->findOneBy(['subject' => $syliusProduct->getId(), 'attribute' => $syliusAttribute->getId()]);

        if (!$attributeValue instanceof ProductAttributeValueInterface) {
            /** @var ProductAttributeValueInterface $value */
            $value = $this->productAttributeValueFactory->createNew();

            return $value;
        }

        return $attributeValue;
    }

    /**
     * @param mixed $odooAttributeValue
     *
     * @return mixed
     */
    public function sanitizeOdooValue($odooAttributeValue, string $odooAttributeType, string $locale)
    {
        if ($odooAttributeType === 'string' && $odooAttributeValue !== false) {
            return (string) $odooAttributeValue;
        }

        if ($odooAttributeType === 'integer' && $odooAttributeValue !== false) {
            return (int) $odooAttributeValue;
        }

        if ($odooAttributeType === 'array' && (!empty($odooAttributeValue) || $odooAttributeValue !== false)) {
            $odooAttributeValue = array_map(function ($attributeValue) use ($locale) {
                //as attribute is not support integer to be value, we add odoo_id as a prefix for ids
                return 'odoo_id_' . $attributeValue; //Urlizer::urlize('odoo_id_' . $attributeValue);
            }, $odooAttributeValue);

            return $odooAttributeValue;
        }

        if ($odooAttributeType === 'double' && $odooAttributeValue !== false) {
            return $odooAttributeValue / 100;
        }

        if ($odooAttributeType === 'date' && $odooAttributeValue !== false) {
            if (date_default_timezone_get()) {
                $timezone = date_default_timezone_get();
            } else {
                $timezone = 'Europe/Paris';
            }
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $odooAttributeValue, new \DateTimeZone('UTC'));

            return $date !== false ? $date->setTimezone(new \DateTimeZone($timezone)) : null;
        }

        if ($odooAttributeType === 'object' && $odooAttributeValue !== false) {
            if (date_default_timezone_get()) {
                $timezone = date_default_timezone_get();
            } else {
                $timezone = 'Europe/Paris';
            }
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $odooAttributeValue, new \DateTimeZone('UTC'));

            return $date !== false ? $date->setTimezone(new \DateTimeZone($timezone)) : null;
        }

        return $odooAttributeValue;
    }
}
