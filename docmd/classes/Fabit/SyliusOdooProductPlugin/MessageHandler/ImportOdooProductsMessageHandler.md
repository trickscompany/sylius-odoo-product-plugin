***

# ImportOdooProductsMessageHandler





* Full name: `\Fabit\SyliusOdooProductPlugin\MessageHandler\ImportOdooProductsMessageHandler`
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

### productDataTransformer



```php
private \Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface $productDataTransformer
```






***

### getProductsCountService



```php
private \Fabit\SyliusOdooProductPlugin\Api\Product\GetProductsCount $getProductsCountService
```






***

### getProductsService



```php
private \Fabit\SyliusOdooProductPlugin\Api\Product\GetProducts $getProductsService
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

### entityManager



```php
private \Doctrine\ORM\EntityManagerInterface $entityManager
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
public __construct(\Symfony\Component\Messenger\MessageBusInterface $messageBus, \Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface $productDataTransformer, \Fabit\SyliusOdooProductPlugin\Api\Product\GetProductsCount $getProductsCountService, \Fabit\SyliusOdooProductPlugin\Api\Product\GetProducts $getProductsService, \Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface $odooProductPluginLogRepository, \Psr\Log\LoggerInterface $logger, \Doctrine\ORM\EntityManagerInterface $entityManager): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$messageBus` | **\Symfony\Component\Messenger\MessageBusInterface** |  |
| `$productDataTransformer` | **\Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface** |  |
| `$getProductsCountService` | **\Fabit\SyliusOdooProductPlugin\Api\Product\GetProductsCount** |  |
| `$getProductsService` | **\Fabit\SyliusOdooProductPlugin\Api\Product\GetProducts** |  |
| `$odooProductPluginLogRepository` | **\Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface** |  |
| `$logger` | **\Psr\Log\LoggerInterface** |  |
| `$entityManager` | **\Doctrine\ORM\EntityManagerInterface** |  |





***

### __invoke



```php
public __invoke(\Fabit\SyliusOdooProductPlugin\Message\ImportOdooProductsMessage $message): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$message` | **\Fabit\SyliusOdooProductPlugin\Message\ImportOdooProductsMessage** |  |





***

### loadProducts



```php
private loadProducts(int $offset, int $limit): array
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$offset` | **int** |  |
| `$limit` | **int** |  |





***

### loadProductsCount



```php
private loadProductsCount(): int
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
