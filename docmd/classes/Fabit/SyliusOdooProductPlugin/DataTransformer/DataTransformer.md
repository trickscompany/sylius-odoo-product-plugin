***

# DataTransformer





* Full name: `\Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformer`
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface`](./DataTransformerInterface.md)



## Properties


### optionsResolver



```php
private \Symfony\Component\OptionsResolver\OptionsResolver $optionsResolver
```






***

### optionConfiguration



```php
private array $optionConfiguration
```






***

## Methods


### __construct



```php
public __construct(array $optionConfiguration): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$optionConfiguration` | **array** |  |





***

### transform



```php
public transform(array $data): object
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **array** |  |





***

### getOptionConfiguration



```php
public getOptionConfiguration(): array
```












***

### configureOptions



```php
private configureOptions(array $optionConfiguration): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$optionConfiguration` | **array** |  |





***

### setRequired



```php
private setRequired(array $optionConfiguration): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$optionConfiguration` | **array** |  |





***

### setDefault



```php
private setDefault(array $optionConfiguration): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$optionConfiguration` | **array** |  |





***

### setAllowedTypes



```php
private setAllowedTypes(array $optionConfiguration): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$optionConfiguration` | **array** |  |





***


***
> Automatically generated on 2024-02-03
