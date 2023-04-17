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
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class ProductVariantResolver implements ProductVariantResolverInterface
{
    /** @var FactoryInterface */
    private $productVariantFactory;
    
    public function __construct(FactoryInterface $productVariantFactory)
    {
        $this->productVariantFactory = $productVariantFactory;
    }
    
    public function resolve(ProductInterface $syliusProduct, Product $product): ProductVariantInterface
    {
        $variant = null;
        if (!empty($syliusProduct->getVariants())) {
            foreach ($syliusProduct->getVariants() as $existingVariant) {
                if (!empty($existingVariant->getOdooProductVariantId()) && $existingVariant->getOdooProductVariantId() == $product->getId()) {
                    $variant = $existingVariant;
                }
            }
        }
        
        //$variant = $syliusProduct->getVariants()->first();
        if (!$variant instanceof ProductVariantInterface) {
            /** @var ProductVariantInterface $variant */
            $variant = $this->productVariantFactory->createNew();
            $variant->setCode($product->getCode());
            $variant->setOdooProductVariantId($product->getId());
            
            $syliusProduct->addVariant($variant);
        }
        
        return $variant;
    }
}
