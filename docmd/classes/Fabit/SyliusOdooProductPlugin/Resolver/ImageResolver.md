***

# ImageResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\ImageResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\ImageResolverInterface`](./ImageResolverInterface.md)
* This class is a **Final class**



## Properties


### productImageRepository



```php
private \Sylius\Component\Resource\Repository\RepositoryInterface $productImageRepository
```






***

### productImageFactory



```php
private \Sylius\Component\Resource\Factory\FactoryInterface $productImageFactory
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Resource\Repository\RepositoryInterface $productImageRepository, \Sylius\Component\Resource\Factory\FactoryInterface $productImageFactory): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$productImageRepository` | **\Sylius\Component\Resource\Repository\RepositoryInterface** |  |
| `$productImageFactory` | **\Sylius\Component\Resource\Factory\FactoryInterface** |  |





***

### resolve



```php
public resolve(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product): \Sylius\Component\Core\Model\ProductImageInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |





***


***
> Automatically generated on 2024-02-03
