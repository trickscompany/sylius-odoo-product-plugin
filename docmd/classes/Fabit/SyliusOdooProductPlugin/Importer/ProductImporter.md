***

# ProductImporter





* Full name: `\Fabit\SyliusOdooProductPlugin\Importer\ProductImporter`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Importer\ProductImporterInterface`](./ProductImporterInterface.md)
* This class is a **Final class**



## Properties


### productResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\ProductResolverInterface $productResolver
```






***

### productVariantResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\ProductVariantResolverInterface $productVariantResolver
```






***

### taxCategoryResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface $taxCategoryResolver
```






***

### channelPricingResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\ChannelPricingResolverInterface $channelPricingResolver
```






***

### imageResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\ImageResolverInterface $imageResolver
```






***

### productAttributeResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeResolverInterface $productAttributeResolver
```






***

### productAttributeValueResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeValueResolverInterface $productAttributeValueResolver
```






***

### productTaxonResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\ProductTaxonResolverInterface $productTaxonResolver
```






***

### productRepository



```php
private \Sylius\Component\Core\Repository\ProductRepositoryInterface $productRepository
```






***

### imageDownloader



```php
private \Fabit\SyliusOdooProductPlugin\Downloader\ImageDownloaderInterface $imageDownloader
```






***

### imageUploader



```php
private \Sylius\Component\Core\Uploader\ImageUploaderInterface $imageUploader
```






***

## Methods


### __construct



```php
public __construct(\Fabit\SyliusOdooProductPlugin\Resolver\ProductResolverInterface $productResolver, \Fabit\SyliusOdooProductPlugin\Resolver\ProductVariantResolverInterface $productVariantResolver, \Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface $taxCategoryResolver, \Fabit\SyliusOdooProductPlugin\Resolver\ChannelPricingResolverInterface $channelPricingResolver, \Fabit\SyliusOdooProductPlugin\Resolver\ImageResolverInterface $imageResolver, \Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeResolverInterface $productAttributeResolver, \Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeValueResolverInterface $productAttributeValueResolver, \Fabit\SyliusOdooProductPlugin\Resolver\ProductTaxonResolverInterface $productTaxonResolver, \Sylius\Component\Core\Repository\ProductRepositoryInterface $productRepository, \Fabit\SyliusOdooProductPlugin\Downloader\ImageDownloaderInterface $imageDownloader, \Sylius\Component\Core\Uploader\ImageUploaderInterface $imageUploader): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$productResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\ProductResolverInterface** |  |
| `$productVariantResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\ProductVariantResolverInterface** |  |
| `$taxCategoryResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface** |  |
| `$channelPricingResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\ChannelPricingResolverInterface** |  |
| `$imageResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\ImageResolverInterface** |  |
| `$productAttributeResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeResolverInterface** |  |
| `$productAttributeValueResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeValueResolverInterface** |  |
| `$productTaxonResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\ProductTaxonResolverInterface** |  |
| `$productRepository` | **\Sylius\Component\Core\Repository\ProductRepositoryInterface** |  |
| `$imageDownloader` | **\Fabit\SyliusOdooProductPlugin\Downloader\ImageDownloaderInterface** |  |
| `$imageUploader` | **\Sylius\Component\Core\Uploader\ImageUploaderInterface** |  |





***

### import



```php
public import(\Fabit\SyliusOdooProductPlugin\Model\Product $product, \Sylius\Component\Core\Model\ChannelInterface $channel, string $locale): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |
| `$channel` | **\Sylius\Component\Core\Model\ChannelInterface** |  |
| `$locale` | **string** |  |





***

### handleProductAttributes



```php
private handleProductAttributes(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product, string $locale): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |
| `$locale` | **string** |  |





***

### handleTranslation



```php
private handleTranslation(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product, string $locale): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |
| `$locale` | **string** |  |





***

### handleChannel



```php
private handleChannel(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Sylius\Component\Core\Model\ChannelInterface $channel): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$channel` | **\Sylius\Component\Core\Model\ChannelInterface** |  |





***

### handleVariants



```php
private handleVariants(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product, \Sylius\Component\Core\Model\ChannelInterface $channel, string $locale): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |
| `$channel` | **\Sylius\Component\Core\Model\ChannelInterface** |  |
| `$locale` | **string** |  |





***

### handleImages



```php
private handleImages(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |





***

### handleChannelPricing



```php
private handleChannelPricing(\Sylius\Component\Core\Model\ProductVariantInterface $variant, \Fabit\SyliusOdooProductPlugin\Model\Product $product, \Sylius\Component\Core\Model\ChannelInterface $channel): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$variant` | **\Sylius\Component\Core\Model\ProductVariantInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |
| `$channel` | **\Sylius\Component\Core\Model\ChannelInterface** |  |





***

### handleProductTaxon



```php
private handleProductTaxon(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |





***


***
> Automatically generated on 2024-02-03
