***

# TaxImporter





* Full name: `\Fabit\SyliusOdooProductPlugin\Importer\TaxImporter`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Importer\TaxImporterInterface`](./TaxImporterInterface.md)
* This class is a **Final class**



## Properties


### taxCategoryResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface $taxCategoryResolver
```






***

### taxRateResolver



```php
private \Fabit\SyliusOdooProductPlugin\Resolver\TaxRateResolverInterface $taxRateResolver
```






***

### taxCategoryRepository



```php
private \Sylius\Component\Taxation\Repository\TaxCategoryRepositoryInterface $taxCategoryRepository
```






***

## Methods


### __construct



```php
public __construct(\Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface $taxCategoryResolver, \Fabit\SyliusOdooProductPlugin\Resolver\TaxRateResolverInterface $taxRateResolver, \Sylius\Component\Taxation\Repository\TaxCategoryRepositoryInterface $taxCategoryRepository): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$taxCategoryResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface** |  |
| `$taxRateResolver` | **\Fabit\SyliusOdooProductPlugin\Resolver\TaxRateResolverInterface** |  |
| `$taxCategoryRepository` | **\Sylius\Component\Taxation\Repository\TaxCategoryRepositoryInterface** |  |





***

### import



```php
public import(\Fabit\SyliusOdooProductPlugin\Model\Data $taxData, \Sylius\Component\Addressing\Model\ZoneInterface $zone): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$taxData` | **\Fabit\SyliusOdooProductPlugin\Model\Data** |  |
| `$zone` | **\Sylius\Component\Addressing\Model\ZoneInterface** |  |





***


***
> Automatically generated on 2024-02-03
