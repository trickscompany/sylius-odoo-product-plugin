***

# OdooController

Controller Odoo Import



* Full name: `\Fabit\SyliusOdooProductPlugin\Controller\OdooController`
* Parent class: [`AbstractController`](../../../Symfony/Bundle/FrameworkBundle/Controller/AbstractController.md)
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**



## Properties


### twig



```php
private \Twig\Environment $twig
```






***

## Methods


### __construct



```php
public __construct(\Twig\Environment $twig): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$twig` | **\Twig\Environment** |  |





***

### __invoke



```php
public __invoke(\Symfony\Component\HttpFoundation\Request $request): \Symfony\Component\HttpFoundation\Response
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Symfony\Component\HttpFoundation\Request** |  |





***

### handleCommand



```php
private handleCommand(\Symfony\Component\HttpFoundation\Request $request, string $command): array
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Symfony\Component\HttpFoundation\Request** |  |
| `$command` | **string** |  |





***

### runProductImportCommand



```php
private runProductImportCommand(\Symfony\Component\HttpFoundation\Request $request, string $channelCode = &#039;&#039;): string
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Symfony\Component\HttpFoundation\Request** |  |
| `$channelCode` | **string** |  |





***

### runTaxImportCommand



```php
private runTaxImportCommand(\Symfony\Component\HttpFoundation\Request $request, string $zone = &#039;&#039;): string
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Symfony\Component\HttpFoundation\Request** |  |
| `$zone` | **string** |  |





***

### runCategoryImportCommand



```php
private runCategoryImportCommand(\Symfony\Component\HttpFoundation\Request $request, string $locale = &#039;&#039;): string
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$request` | **\Symfony\Component\HttpFoundation\Request** |  |
| `$locale` | **string** |  |





***

### runCommand



```php
private runCommand(string $command, array $arguments = []): string
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$command` | **string** |  |
| `$arguments` | **array** |  |





***


***
> Automatically generated on 2024-02-03
