***

# ChannelPricingResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\ChannelPricingResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\ChannelPricingResolverInterface`](./ChannelPricingResolverInterface.md)
* This class is a **Final class**



## Properties


### channelPricingRepository



```php
private \Sylius\Component\Resource\Repository\RepositoryInterface $channelPricingRepository
```






***

### channelPricingFactory



```php
private \Sylius\Component\Resource\Factory\FactoryInterface $channelPricingFactory
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Resource\Repository\RepositoryInterface $channelPricingRepository, \Sylius\Component\Resource\Factory\FactoryInterface $channelPricingFactory): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$channelPricingRepository` | **\Sylius\Component\Resource\Repository\RepositoryInterface** |  |
| `$channelPricingFactory` | **\Sylius\Component\Resource\Factory\FactoryInterface** |  |





***

### resolve



```php
public resolve(\Sylius\Component\Core\Model\ProductVariantInterface $variant, \Fabit\SyliusOdooProductPlugin\Model\Product $product): \Sylius\Component\Core\Model\ChannelPricingInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$variant` | **\Sylius\Component\Core\Model\ProductVariantInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |





***


***
> Automatically generated on 2024-02-03
