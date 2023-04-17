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

use Fabit\SyliusOdooProductPlugin\Model\Data;
use Fabit\SyliusOdooProductPlugin\Model\Product;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;
use Sylius\Component\Taxation\Repository\TaxCategoryRepositoryInterface;

final class TaxCategoryResolver implements TaxCategoryResolverInterface
{
    /** @var TaxCategoryRepositoryInterface */
    private $taxCategoryRepository;

    /** @var FactoryInterface */
    private $taxCategoryFactory;

    public function __construct(TaxCategoryRepositoryInterface $taxCategoryRepository, FactoryInterface $taxCategoryFactory)
    {
        $this->taxCategoryRepository = $taxCategoryRepository;
        $this->taxCategoryFactory = $taxCategoryFactory;
    }

    public function resolveByTax(Data $taxData): TaxCategoryInterface
    {
        $taxCategory = $this->taxCategoryRepository->findOneBy(['code' => (string) $taxData->getData()['id']]);

        if (!$taxCategory instanceof TaxCategoryInterface) {
            /** @var TaxCategoryInterface $taxCategory */
            $taxCategory = $this->taxCategoryFactory->createNew();
        }

        return $taxCategory;
    }

    public function resolveByProduct(ProductInterface $syliusProduct, Product $product): ?TaxCategoryInterface
    {
        $_data = $product->getData();
        if (empty($product->getData()['taxes_id'])) {
            return null;
        }

        $taxCategoryId = current($product->getData()['taxes_id']);
        $taxCategory = $this->taxCategoryRepository->findOneBy(['code' => $taxCategoryId]);

        if (!$taxCategory instanceof TaxCategoryInterface) {
            throw new \Exception(sprintf('Tax category with id %s is not imported. Please import Tax Categories', $taxCategoryId));
        }

        return $taxCategory;
    }
}
