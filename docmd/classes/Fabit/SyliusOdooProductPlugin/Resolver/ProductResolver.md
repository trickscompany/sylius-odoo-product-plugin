***

# ProductResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\ProductResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\ProductResolverInterface`](./ProductResolverInterface.md)
* This class is a **Final class**



## Properties


### productRepository



```php
private \Sylius\Component\Core\Repository\ProductRepositoryInterface $productRepository
```






***

### productFactory



```php
private \Sylius\Component\Resource\Factory\FactoryInterface $productFactory
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Core\Repository\ProductRepositoryInterface $productRepository, \Sylius\Component\Resource\Factory\FactoryInterface $productFactory): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$productRepository` | **\Sylius\Component\Core\Repository\ProductRepositoryInterface** |  |
| `$productFactory` | **\Sylius\Component\Resource\Factory\FactoryInterface** |  |





***

### resolve



```php
public resolve(\Fabit\SyliusOdooProductPlugin\Model\Product $product): \Sylius\Component\Core\Model\ProductInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |





***


***
> Automatically generated on 2024-02-03
