***

# ImportOdooCategorisMessageHandler





* Full name: `\Fabit\SyliusOdooProductPlugin\MessageHandler\ImportOdooCategorisMessageHandler`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Symfony\Component\Messenger\Handler\MessageHandlerInterface`](../../../Symfony/Component/Messenger/Handler/MessageHandlerInterface.md)
* This class is a **Final class**



## Properties


### messageBus



```php
private \Symfony\Component\Messenger\MessageBusInterface $messageBus
```






***

### categoryDataTransformer



```php
private \Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface $categoryDataTransformer
```






***

### getCategoryService



```php
private \Fabit\SyliusOdooProductPlugin\Api\Category\GetCategory $getCategoryService
```






***

### getCategoryCountService



```php
private \Fabit\SyliusOdooProductPlugin\Api\Category\GetCategoryCount $getCategoryCountService
```






***

### odooProductPluginLogRepository

OdooProductPluginLogRepository *

```php
private $odooProductPluginLogRepository
```






***

### logger



```php
public \Psr\Log\LoggerInterface $logger
```






***

### odooProductPluginLog



```php
private \Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog $odooProductPluginLog
```






***

## Methods


### __construct



```php
public __construct(\Symfony\Component\Messenger\MessageBusInterface $messageBus, \Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface $categoryDataTransformer, \Fabit\SyliusOdooProductPlugin\Api\Category\GetCategoryCount $getCategoryCountService, \Fabit\SyliusOdooProductPlugin\Api\Category\GetCategory $getCategoryService, \Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface $odooProductPluginLogRepository, \Psr\Log\LoggerInterface $logger): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$messageBus` | **\Symfony\Component\Messenger\MessageBusInterface** |  |
| `$categoryDataTransformer` | **\Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface** |  |
| `$getCategoryCountService` | **\Fabit\SyliusOdooProductPlugin\Api\Category\GetCategoryCount** |  |
| `$getCategoryService` | **\Fabit\SyliusOdooProductPlugin\Api\Category\GetCategory** |  |
| `$odooProductPluginLogRepository` | **\Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface** |  |
| `$logger` | **\Psr\Log\LoggerInterface** |  |





***

### __invoke



```php
public __invoke(\Fabit\SyliusOdooProductPlugin\Message\ImportOdooCategorisMessage $message): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$message` | **\Fabit\SyliusOdooProductPlugin\Message\ImportOdooCategorisMessage** |  |





***

### loadCategories



```php
private loadCategories(int $offset, int $limit): array
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$offset` | **int** |  |
| `$limit` | **int** |  |





***

### loadCategoryCount



```php
private loadCategoryCount(): int
```












***

### setFilter



```php
private setFilter(): mixed
```












***

### updateLastSync



```php
private updateLastSync(): mixed
```












***

### debug



```php
private debug(string $message, array $data = []): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$message` | **string** |  |
| `$data` | **array** |  |





***


***
> Automatically generated on 2024-02-03
