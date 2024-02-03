***

# ImportOdooProductMessageHandler





* Full name: `\Fabit\SyliusOdooProductPlugin\MessageHandler\ImportOdooProductMessageHandler`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Symfony\Component\Messenger\Handler\MessageHandlerInterface`](../../../Symfony/Component/Messenger/Handler/MessageHandlerInterface.md)
* This class is a **Final class**



## Properties


### productImporter



```php
private \Fabit\SyliusOdooProductPlugin\Importer\ProductImporterInterface $productImporter
```






***

## Methods


### __construct



```php
public __construct(\Fabit\SyliusOdooProductPlugin\Importer\ProductImporterInterface $productImporter): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$productImporter` | **\Fabit\SyliusOdooProductPlugin\Importer\ProductImporterInterface** |  |





***

### __invoke



```php
public __invoke(\Fabit\SyliusOdooProductPlugin\Message\ImportOdooProductMessage $message): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$message` | **\Fabit\SyliusOdooProductPlugin\Message\ImportOdooProductMessage** |  |





***


***
> Automatically generated on 2024-02-03
