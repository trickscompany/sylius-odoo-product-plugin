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
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class ProductResolver implements ProductResolverInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;

    /** @var FactoryInterface */
    private $productFactory;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        FactoryInterface $productFactory
    ) {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
    }

    public function resolve(Product $product): ProductInterface
    {
        if (null === $product->getId()) {
            throw new \InvalidArgumentException('Product id is missing');
        }

        //Get product from DB by odoo product id
        $syliusProduct = $this->productRepository->findOneBy(['odooProductTmplId' => $product->getProductTmplId()]);
        if (!$syliusProduct instanceof ProductInterface) {
            if (!empty($product->getCode())) {
                $syliusProduct = $this->productRepository->findOneByCode($product->getCode());
            }
        }

        if (!$syliusProduct instanceof ProductInterface) {
            /** @var ProductInterface $syliusProduct */
            $syliusProduct = $this->productFactory->createNew();
        }

        return $syliusProduct;
    }
}
