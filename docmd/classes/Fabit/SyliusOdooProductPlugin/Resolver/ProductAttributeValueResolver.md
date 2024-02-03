***

# ProductAttributeValueResolver





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeValueResolver`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Resolver\ProductAttributeValueResolverInterface`](./ProductAttributeValueResolverInterface.md)
* This class is a **Final class**



## Properties


### productAttributeValueRepository



```php
private \Sylius\Component\Product\Repository\ProductAttributeValueRepositoryInterface $productAttributeValueRepository
```






***

### productAttributeValueFactory



```php
private \Sylius\Component\Resource\Factory\FactoryInterface $productAttributeValueFactory
```






***

## Methods


### __construct



```php
public __construct(\Sylius\Component\Product\Repository\ProductAttributeValueRepositoryInterface $productAttributeValueRepository, \Sylius\Component\Resource\Factory\FactoryInterface $productAttributeValueFactory): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$productAttributeValueRepository` | **\Sylius\Component\Product\Repository\ProductAttributeValueRepositoryInterface** |  |
| `$productAttributeValueFactory` | **\Sylius\Component\Resource\Factory\FactoryInterface** |  |





***

### resolve



```php
public resolve(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\ProductAttribute $productAttribute, \Sylius\Component\Product\Model\ProductAttributeInterface $syliusAttribute, string $locale): ?\Sylius\Component\Product\Model\ProductAttributeValueInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$productAttribute` | **\Fabit\SyliusOdooProductPlugin\Model\ProductAttribute** |  |
| `$syliusAttribute` | **\Sylius\Component\Product\Model\ProductAttributeInterface** |  |
| `$locale` | **string** |  |





***

### isValueNotEmpty



```php
private isValueNotEmpty(mixed $sanitisedValue): bool
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$sanitisedValue` | **mixed** |  |





***

### loadProductAttributeValue



```php
private loadProductAttributeValue(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Sylius\Component\Product\Model\ProductAttributeInterface $syliusAttribute): \Sylius\Component\Product\Model\ProductAttributeValueInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$syliusAttribute` | **\Sylius\Component\Product\Model\ProductAttributeInterface** |  |





***

### sanitizeOdooValue



```php
public sanitizeOdooValue(mixed $odooAttributeValue, string $odooAttributeType, string $locale): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$odooAttributeValue` | **mixed** |  |
| `$odooAttributeType` | **string** |  |
| `$locale` | **string** |  |





***


***
> Automatically generated on 2024-02-03
