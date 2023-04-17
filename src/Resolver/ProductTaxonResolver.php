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

use Fabit\SyliusOdooProductPlugin\Model\Product;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTaxonInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class ProductTaxonResolver implements ProductTaxonResolverInterface
{
    /** @var FactoryInterface */
    private $productTaxonFactory;

    /** @var RepositoryInterface */
    private $productTaxonRepository;

    /** @var RepositoryInterface */
    private $taxonRepository;

    public function __construct(FactoryInterface $productTaxonFactory, RepositoryInterface $productTaxonRepository, RepositoryInterface $taxonRepository)
    {
        $this->productTaxonFactory = $productTaxonFactory;
        $this->productTaxonRepository = $productTaxonRepository;
        $this->taxonRepository = $taxonRepository;
    }

    public function resolve(ProductInterface $syliusProduct, Product $product, ?int $position = null): ? ProductTaxonInterface
    {
        $productTaxon = null;
        $taxon = null;
        $_data = $product->getData();
        if (!empty($_data['categ_id']) && is_array($_data['categ_id']) && !empty($_data['categ_id'][0])) {
            $taxon = $this->taxonRepository->findOneBy(['code' => $_data['categ_id'][0]]);
        }

        if ($taxon instanceof TaxonInterface) {
            //Check if product taxon is exist
            $productTaxon = $this->productTaxonRepository->findOneBy(['product' => $syliusProduct->getId(), 'taxon' => $taxon]);

            if (!$productTaxon instanceof ProductTaxonInterface) {
                /** @var ProductTaxonInterface $productTaxon */
                $productTaxon = $this->productTaxonFactory->createNew();

                $productTaxon->setTaxon($taxon);
            }
        }

        return $productTaxon;
    }
}
