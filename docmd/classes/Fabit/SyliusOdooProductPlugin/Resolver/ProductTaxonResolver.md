***

# ProductTaxonResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\ProductTaxonResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\ProductTaxonResolverInterface`](./ProductTaxonResolverInterface.md)
* This class is a **Final class**



## Properties


### productTaxonFactory



```php
private \Sylius\Component\Resource\Factory\FactoryInterface $productTaxonFactory
```






***

### productTaxonRepository



```php
private \Sylius\Component\Resource\Repository\RepositoryInterface $productTaxonRepository
```






***

### taxonRepository



```php
private \Sylius\Component\Resource\Repository\RepositoryInterface $taxonRepository
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Resource\Factory\FactoryInterface $productTaxonFactory, \Sylius\Component\Resource\Repository\RepositoryInterface $productTaxonRepository, \Sylius\Component\Resource\Repository\RepositoryInterface $taxonRepository): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$productTaxonFactory` | **\Sylius\Component\Resource\Factory\FactoryInterface** |  |
| `$productTaxonRepository` | **\Sylius\Component\Resource\Repository\RepositoryInterface** |  |
| `$taxonRepository` | **\Sylius\Component\Resource\Repository\RepositoryInterface** |  |





***

### resolve



```php
public resolve(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product, ?int $position = null): ?\Sylius\Component\Core\Model\ProductTaxonInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |
| `$position` | **?int** |  |





***


***
> Automatically generated on 2024-02-03
