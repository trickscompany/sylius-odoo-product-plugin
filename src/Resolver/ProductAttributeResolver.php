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
use Sylius\Component\Attribute\AttributeType\CheckboxAttributeType;
use Sylius\Component\Attribute\AttributeType\DateAttributeType;
use Sylius\Component\Attribute\AttributeType\DatetimeAttributeType;
use Sylius\Component\Attribute\AttributeType\IntegerAttributeType;
use Sylius\Component\Attribute\AttributeType\PercentAttributeType;
use Sylius\Component\Attribute\AttributeType\SelectAttributeType;
use Sylius\Component\Attribute\AttributeType\TextAttributeType;
use Sylius\Component\Attribute\Factory\AttributeFactoryInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class ProductAttributeResolver implements ProductAttributeResolverInterface
{
    /** @var AttributeFactoryInterface */
    private $productAttributeFactory;

    /** @var RepositoryInterface */
    private $productAttributeRepository;

    public function __construct(
        RepositoryInterface $productAttributeRepository,
        AttributeFactoryInterface $productAttributeFactory
    ) {
        $this->productAttributeFactory = $productAttributeFactory;
        $this->productAttributeRepository = $productAttributeRepository;
    }

    public function resolve(ProductInterface $syliusProduct, ProductAttribute $productAttribute, string $locale): ProductAttributeInterface
    {
        $attribute = $this->productAttributeRepository->findOneBy(['code' => $productAttribute->code]);

        //Check if attribute type is changed in configuration
        if ($attribute instanceof ProductAttributeInterface) {
            if ($this->getAttributeType($productAttribute->type) != $attribute->getType()) {
                $attribute->setType($this->getAttributeType($productAttribute->type));
                $attribute->setStorageType($this->getAttributeType($productAttribute->type));

                //Save updated value in DB
                $this->productAttributeRepository->add($attribute);

                //Get attribute updatede object again
                $attribute = $this->productAttributeRepository->findOneBy(['code' => $productAttribute->code]);
            }
        }

        if (!$attribute instanceof ProductAttributeInterface) {
            /** @var ProductAttributeInterface $attribute */
            $attribute = $this->productAttributeFactory->createTyped($this->getAttributeType($productAttribute->type));
            $attribute->setCode($productAttribute->code);
            $attribute->setCurrentLocale($locale);
            $attribute->setFallbackLocale($locale);
            $attribute->setName(ucfirst(str_replace('_', ' ', $productAttribute->code)));

            $this->productAttributeRepository->add($attribute);
        }

        return $attribute;
    }

    private function getAttributeType(string $odooAttributeType): string
    {
        switch ($odooAttributeType) {
            case 'array':
                return SelectAttributeType::TYPE;
            case 'integer':
                return IntegerAttributeType::TYPE;
            case 'double':
                return PercentAttributeType::TYPE;
            case 'date':
                return DateAttributeType::TYPE;
            case 'date':
                return DatetimeAttributeType::TYPE;
            case 'object':
                return DatetimeAttributeType::TYPE;
            case 'string':
                return TextAttributeType::TYPE;
            case 'boolean':
                return CheckboxAttributeType::TYPE;
            case 'percent':
                return PercentAttributeType::TYPE;
        }

        return 'null';
    }
}
