***

# ProductVariantResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\ProductVariantResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\ProductVariantResolverInterface`](./ProductVariantResolverInterface.md)
* This class is a **Final class**



## Properties


### productVariantFactory



```php
private \Sylius\Component\Resource\Factory\FactoryInterface $productVariantFactory
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Resource\Factory\FactoryInterface $productVariantFactory): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$productVariantFactory` | **\Sylius\Component\Resource\Factory\FactoryInterface** |  |





***

### resolve



```php
public resolve(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product): \Sylius\Component\Core\Model\ProductVariantInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |





***


***
> Automatically generated on 2024-02-03
