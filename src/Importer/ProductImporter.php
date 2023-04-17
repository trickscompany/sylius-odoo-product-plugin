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

namespace Fabit\SyliusOdooProductPlugin\Importer;

use Fabit\SyliusOdooProductPlugin\Downloader\ImageDownloaderInterface;
use Fabit\SyliusOdooProductPlugin\Model\Product;
use Fabit\SyliusOdooProductPlugin\Resolver\ChannelPricingResolverInterface;
use Fabit\SyliusOdooProductPlugin\Resolver\ImageResolverInterface;
use Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeResolverInterface;
use Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeValueResolverInterface;
use Fabit\SyliusOdooProductPlugin\Resolver\ProductResolverInterface;
use Fabit\SyliusOdooProductPlugin\Resolver\ProductTaxonResolverInterface;
use Fabit\SyliusOdooProductPlugin\Resolver\ProductVariantResolverInterface;
use Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Component\Product\Model\ProductAttributeValueInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class ProductImporter implements ProductImporterInterface
{
    /** @var ProductResolverInterface */
    private $productResolver;

    /** @var ProductVariantResolverInterface */
    private $productVariantResolver;

    /** @var TaxCategoryResolverInterface */
    private $taxCategoryResolver;

    /** @var ChannelPricingResolverInterface */
    private $channelPricingResolver;

    /** @var ImageResolverInterface */
    private $imageResolver;

    /** @var ProductAttributeResolverInterface */
    private $productAttributeResolver;

    /** @var ProductAttributeValueResolverInterface */
    private $productAttributeValueResolver;

    /** @var ProductTaxonResolverInterface */
    private $productTaxonResolver;

    /** @var ProductRepositoryInterface */
    private $productRepository;

    /** @var ImageDownloaderInterface */
    private $imageDownloader;

    /** @var ImageUploaderInterface */
    private $imageUploader;

    public function __construct(
        ProductResolverInterface $productResolver,
        ProductVariantResolverInterface $productVariantResolver,
        TaxCategoryResolverInterface $taxCategoryResolver,
        ChannelPricingResolverInterface $channelPricingResolver,
        ImageResolverInterface $imageResolver,
        ProductAttributeResolverInterface $productAttributeResolver,
        ProductAttributeValueResolverInterface $productAttributeValueResolver,
        ProductTaxonResolverInterface $productTaxonResolver,
        ProductRepositoryInterface $productRepository,
        ImageDownloaderInterface $imageDownloader,
        ImageUploaderInterface $imageUploader
    ) {
        $this->productResolver = $productResolver;
        $this->productVariantResolver = $productVariantResolver;
        $this->taxCategoryResolver = $taxCategoryResolver;
        $this->channelPricingResolver = $channelPricingResolver;
        $this->imageResolver = $imageResolver;
        $this->productAttributeResolver = $productAttributeResolver;
        $this->productAttributeValueResolver = $productAttributeValueResolver;
        $this->productTaxonResolver = $productTaxonResolver;
        $this->productRepository = $productRepository;
        $this->imageDownloader = $imageDownloader;
        $this->imageUploader = $imageUploader;
    }

    public function import(Product $product, ChannelInterface $channel, string $locale): void
    {
        if (is_bool($product->getCode())) {
            return;
        }

        $syliusProduct = $this->productResolver->resolve($product);
        $syliusProduct->setCode($product->getCode());
        $syliusProduct->setOdooProductTmplId($product->getProductTmplId());

        $syliusProduct->setEnabled($product->isActive());
        $syliusProduct->setCurrentLocale($locale);

        $this->handleChannel($syliusProduct, $channel);
        $this->handleTranslation($syliusProduct, $product, $locale);
        $this->handleVariants($syliusProduct, $product, $channel, $locale);
        $this->handleImages($syliusProduct, $product);
        $this->handleProductTaxon($syliusProduct, $product);

        $this->productRepository->add($syliusProduct);

        $this->handleProductAttributes($syliusProduct, $product, $locale);
    }

    private function handleProductAttributes(ProductInterface $syliusProduct, Product $product, string $locale): void
    {
        foreach ($product->getAttributes() as $attribute) {
            $productAttribute = $this->productAttributeResolver->resolve($syliusProduct, $attribute, $locale);
            $productAttributeValue = $this->productAttributeValueResolver->resolve($syliusProduct, $attribute, $productAttribute, $locale);

            if ($productAttributeValue instanceof ProductAttributeValueInterface) {
                $syliusProduct->addAttribute($productAttributeValue);
            }
        }
    }

    private function handleTranslation(ProductInterface $syliusProduct, Product $product, string $locale): void
    {
        $productTranslation = $syliusProduct->getTranslation($locale);
        $productTranslation->setName($product->getName());
        $productTranslation->setSlug(Urlizer::urlize(\sprintf('%s-%s', $product->getName(), $product->getCode())));
        $productTranslation->setTranslatable($syliusProduct);

        if (is_string($product->getDescription())) {
            $productTranslation->setDescription($product->getDescription());
        }
    }

    private function handleChannel(ProductInterface $syliusProduct, ChannelInterface $channel): void
    {
        if (!$syliusProduct->hasChannel($channel)) {
            $syliusProduct->addChannel($channel);
        }
    }

    private function handleVariants(ProductInterface $syliusProduct, Product $product, ChannelInterface $channel, string $locale): void
    {
        $variant = $this->productVariantResolver->resolve($syliusProduct, $product);

        $variant->setCurrentLocale($locale);
        $variant->setProduct($syliusProduct);
        $variant->setCode($syliusProduct->getCode());

        $variant->setShippingRequired(true);

        $variant->setName($product->getName());

        $variant->setTaxCategory($this->taxCategoryResolver->resolveByProduct($syliusProduct, $product));

        $this->handleChannelPricing($variant, $product, $channel);
    }

    private function handleImages(ProductInterface $syliusProduct, Product $product): void
    {
        if (empty($product->getImag1920()) || is_bool($product->getImag1920())) {
            return;
        }

        $productImage = $this->imageResolver->resolve($syliusProduct, $product);
        $syliusProduct->removeImage($productImage);

        $imagePath = $this->imageDownloader->saveImage($product->getImag1920(), 'png');

        $productImage->setOwner($product);
        $productImage->setFile(new UploadedFile($imagePath, basename($imagePath)));
        $productImage->setType('main');
        $this->imageUploader->upload($productImage);

        $syliusProduct->addImage($productImage);
    }

    private function handleChannelPricing(ProductVariantInterface $variant, Product $product, ChannelInterface $channel): void
    {
        $_data = $product->getData();

        $channelPricing = $this->channelPricingResolver->resolve($variant, $product);
        $channelPricing->setPrice((int) ($_data['lst_price'] * 100));
        $channelPricing->setOriginalPrice((int) ($_data['lst_price'] * 100));

        $channelPricing->setChannelCode($channel->getCode());
        $channelPricing->setProductVariant($variant);

        $variant->addChannelPricing($channelPricing);
    }

    private function handleProductTaxon(ProductInterface $syliusProduct, Product $product): void
    {
        $_data = $product->getData();
        if (!isset($_data['categ_id'])) {
            return;
        }

        $productTaxon = $this->productTaxonResolver->resolve($syliusProduct, $product);
        if (null !== $productTaxon) {
            $syliusProduct->addProductTaxon($productTaxon);
        }
    }
}
