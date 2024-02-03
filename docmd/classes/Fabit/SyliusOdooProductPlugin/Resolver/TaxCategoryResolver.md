***

# TaxCategoryResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface`](./TaxCategoryResolverInterface.md)
* This class is a **Final class**



## Properties


### taxCategoryRepository



```php
private \Sylius\Component\Taxation\Repository\TaxCategoryRepositoryInterface $taxCategoryRepository
```






***

### taxCategoryFactory



```php
private \Sylius\Component\Resource\Factory\FactoryInterface $taxCategoryFactory
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Taxation\Repository\TaxCategoryRepositoryInterface $taxCategoryRepository, \Sylius\Component\Resource\Factory\FactoryInterface $taxCategoryFactory): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$taxCategoryRepository` | **\Sylius\Component\Taxation\Repository\TaxCategoryRepositoryInterface** |  |
| `$taxCategoryFactory` | **\Sylius\Component\Resource\Factory\FactoryInterface** |  |





***

### resolveByTax



```php
public resolveByTax(\Fabit\SyliusOdooProductPlugin\Model\Data $taxData): \Sylius\Component\Taxation\Model\TaxCategoryInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$taxData` | **\Fabit\SyliusOdooProductPlugin\Model\Data** |  |





***

### resolveByProduct



```php
public resolveByProduct(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product): ?\Sylius\Component\Taxation\Model\TaxCategoryInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |





***


***
> Automatically generated on 2024-02-03
