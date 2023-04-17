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
use Sylius\Component\Core\Model\ChannelPricingInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class ChannelPricingResolver implements ChannelPricingResolverInterface
{
    /** @var RepositoryInterface */
    private $channelPricingRepository;

    /** @var FactoryInterface */
    private $channelPricingFactory;

    public function __construct(
        RepositoryInterface $channelPricingRepository,
        FactoryInterface $channelPricingFactory
    ) {
        $this->channelPricingRepository = $channelPricingRepository;
        $this->channelPricingFactory = $channelPricingFactory;
    }

    public function resolve(ProductVariantInterface $variant, Product $product): ChannelPricingInterface
    {
        $channelPricing = $this->channelPricingRepository->findOneBy(['productVariant' => $variant->getId()]);

        if (!$channelPricing instanceof ChannelPricingInterface) {
            /** @var ChannelPricingInterface $channelPricing */
            $channelPricing = $this->channelPricingFactory->createNew();
        }

        return $channelPricing;
    }
}
