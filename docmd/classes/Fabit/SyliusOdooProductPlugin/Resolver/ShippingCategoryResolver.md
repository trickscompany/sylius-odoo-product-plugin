***

# ShippingCategoryResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\ShippingCategoryResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\ShippingCategoryResolverInterface`](./ShippingCategoryResolverInterface.md)
* This class is a **Final class**



## Properties


### shippingCategoryRepository



```php
private \Sylius\Component\Core\Repository\ShippingCategoryRepositoryInterface $shippingCategoryRepository
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Core\Repository\ShippingCategoryRepositoryInterface $shippingCategoryRepository): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$shippingCategoryRepository` | **\Sylius\Component\Core\Repository\ShippingCategoryRepositoryInterface** |  |





***

### resolve



```php
public resolve(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product): \Sylius\Component\Shipping\Model\ShippingCategoryInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |





***


***
> Automatically generated on 2024-02-03
