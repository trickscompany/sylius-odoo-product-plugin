***

# ProductAttributeResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeResolverInterface`](./ProductAttributeResolverInterface.md)
* This class is a **Final class**



## Properties


### productAttributeFactory



```php
private \Sylius\Component\Attribute\Factory\AttributeFactoryInterface $productAttributeFactory
```






***

### productAttributeRepository



```php
private \Sylius\Component\Resource\Repository\RepositoryInterface $productAttributeRepository
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Resource\Repository\RepositoryInterface $productAttributeRepository, \Sylius\Component\Attribute\Factory\AttributeFactoryInterface $productAttributeFactory): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$productAttributeRepository` | **\Sylius\Component\Resource\Repository\RepositoryInterface** |  |
| `$productAttributeFactory` | **\Sylius\Component\Attribute\Factory\AttributeFactoryInterface** |  |





***

### resolve



```php
public resolve(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\ProductAttribute $productAttribute, string $locale): \Sylius\Component\Product\Model\ProductAttributeInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$productAttribute` | **\Fabit\SyliusOdooProductPlugin\Model\ProductAttribute** |  |
| `$locale` | **string** |  |





***

### getAttributeType



```php
private getAttributeType(string $odooAttributeType): string
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$odooAttributeType` | **string** |  |





***


***
> Automatically generated on 2024-02-03
