***

# TaxRateResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\TaxRateResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\TaxRateResolverInterface`](./TaxRateResolverInterface.md)
* This class is a **Final class**



## Properties


### taxRateRepository



```php
private \Sylius\Component\Resource\Repository\RepositoryInterface $taxRateRepository
```






***

### taxRateFactory



```php
private \Sylius\Component\Resource\Factory\FactoryInterface $taxRateFactory
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Resource\Repository\RepositoryInterface $taxRateRepository, \Sylius\Component\Resource\Factory\FactoryInterface $taxRateFactory): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$taxRateRepository` | **\Sylius\Component\Resource\Repository\RepositoryInterface** |  |
| `$taxRateFactory` | **\Sylius\Component\Resource\Factory\FactoryInterface** |  |





***

### resolve



```php
public resolve(\Sylius\Component\Taxation\Model\TaxCategoryInterface $taxCategory, \Sylius\Component\Addressing\Model\ZoneInterface $zone): \Sylius\Component\Core\Model\TaxRateInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$taxCategory` | **\Sylius\Component\Taxation\Model\TaxCategoryInterface** |  |
| `$zone` | **\Sylius\Component\Addressing\Model\ZoneInterface** |  |





***


***
> Automatically generated on 2024-02-03
