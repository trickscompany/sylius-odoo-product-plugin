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
use Sylius\Component\Core\Model\ProductImageInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class ImageResolver implements ImageResolverInterface
{
    /** @var RepositoryInterface */
    private $productImageRepository;

    /** @var FactoryInterface */
    private $productImageFactory;

    public function __construct(RepositoryInterface $productImageRepository, FactoryInterface $productImageFactory)
    {
        $this->productImageRepository = $productImageRepository;
        $this->productImageFactory = $productImageFactory;
    }

    public function resolve(ProductInterface $syliusProduct, Product $product): ProductImageInterface
    {
        $productImage = null;
        if ($syliusProduct->getId() !== null) {
            $productImage = $this->productImageRepository->findOneBy(['owner' => $syliusProduct->getId()]);
        }

        if (!$productImage instanceof ProductImageInterface) {
            /** @var ProductImageInterface $productImage */
            $productImage = $this->productImageFactory->createNew();
        }

        return $productImage;
    }
}
