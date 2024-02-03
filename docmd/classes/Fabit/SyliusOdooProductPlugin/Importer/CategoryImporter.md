***

# CategoryImporter





* Full name: `\Fabit\SyliusOdooProductPlugin\Importer\CategoryImporter`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Importer\CategoryImporterInterface`](./CategoryImporterInterface.md)
* This class is a **Final class**



## Properties


### taxonFactory



```php
private \Sylius\Component\Taxonomy\Factory\TaxonFactoryInterface $taxonFactory
```






***

### taxonRepository



```php
private \Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface $taxonRepository
```






***

### entityManager



```php
private \Doctrine\ORM\EntityManagerInterface $entityManager
```






***

### taxonSlugGenerator



```php
private \Sylius\Component\Taxonomy\Generator\TaxonSlugGeneratorInterface $taxonSlugGenerator
```






***

### logger



```php
public \Psr\Log\LoggerInterface $logger
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Taxonomy\Factory\TaxonFactoryInterface $taxonFactory, \Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface $taxonRepository, \Doctrine\ORM\EntityManagerInterface $entityManager, \Sylius\Component\Taxonomy\Generator\TaxonSlugGeneratorInterface $taxonSlugGenerator, \Psr\Log\LoggerInterface $logger): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$taxonFactory` | **\Sylius\Component\Taxonomy\Factory\TaxonFactoryInterface** |  |
| `$taxonRepository` | **\Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface** |  |
| `$entityManager` | **\Doctrine\ORM\EntityManagerInterface** |  |
| `$taxonSlugGenerator` | **\Sylius\Component\Taxonomy\Generator\TaxonSlugGeneratorInterface** |  |
| `$logger` | **\Psr\Log\LoggerInterface** |  |





***

### import



```php
public import(array $data, string $locale): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **array** |  |
| `$locale` | **string** |  |





***

### createTaxon



```php
private createTaxon(mixed $code, mixed $name, mixed $locale): \Sylius\Component\Core\Model\TaxonInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$code` | **mixed** |  |
| `$name` | **mixed** |  |
| `$locale` | **mixed** |  |





***

### debug



```php
private debug(string $message, array $data = [], bool $isEcho = false): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$message` | **string** |  |
| `$data` | **array** |  |
| `$isEcho` | **bool** |  |





***


***
> Automatically generated on 2024-02-03
