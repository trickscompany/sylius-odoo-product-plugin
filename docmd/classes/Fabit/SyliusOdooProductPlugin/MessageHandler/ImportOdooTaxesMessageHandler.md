***

# ImportOdooTaxesMessageHandler





* Full name: `\Fabit\SyliusOdooProductPlugin\MessageHandler\ImportOdooTaxesMessageHandler`
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

### taxDataTransformer



```php
private \Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface $taxDataTransformer
```






***

### getTaxesService



```php
private \Fabit\SyliusOdooProductPlugin\Api\Tax\GetTax $getTaxesService
```






***

### getTaxesCountService



```php
private \Fabit\SyliusOdooProductPlugin\Api\Tax\GetTaxCount $getTaxesCountService
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
public __construct(\Symfony\Component\Messenger\MessageBusInterface $messageBus, \Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface $taxDataTransformer, \Fabit\SyliusOdooProductPlugin\Api\Tax\GetTaxCount $getTaxesCountService, \Fabit\SyliusOdooProductPlugin\Api\Tax\GetTax $getTaxesService, \Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface $odooProductPluginLogRepository, \Psr\Log\LoggerInterface $logger): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$messageBus` | **\Symfony\Component\Messenger\MessageBusInterface** |  |
| `$taxDataTransformer` | **\Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface** |  |
| `$getTaxesCountService` | **\Fabit\SyliusOdooProductPlugin\Api\Tax\GetTaxCount** |  |
| `$getTaxesService` | **\Fabit\SyliusOdooProductPlugin\Api\Tax\GetTax** |  |
| `$odooProductPluginLogRepository` | **\Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface** |  |
| `$logger` | **\Psr\Log\LoggerInterface** |  |





***

### __invoke



```php
public __invoke(\Fabit\SyliusOdooProductPlugin\Message\ImportOdooTaxesMessage $message): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$message` | **\Fabit\SyliusOdooProductPlugin\Message\ImportOdooTaxesMessage** |  |





***

### loadTaxes



```php
private loadTaxes(int $offset, int $limit): array
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$offset` | **int** |  |
| `$limit` | **int** |  |





***

### loadTaxesCount



```php
private loadTaxesCount(): int
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
