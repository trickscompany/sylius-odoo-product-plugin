***

# ImportOdooCategoryMessageHandler





* Full name: `\Fabit\SyliusOdooProductPlugin\MessageHandler\ImportOdooCategoryMessageHandler`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Symfony\Component\Messenger\Handler\MessageHandlerInterface`](../../../Symfony/Component/Messenger/Handler/MessageHandlerInterface.md)
* This class is a **Final class**



## Properties


### categoryImporter



```php
private \Fabit\SyliusOdooProductPlugin\Importer\CategoryImporterInterface $categoryImporter
```






***

## Methods


### __construct



```php
public __construct(\Fabit\SyliusOdooProductPlugin\Importer\CategoryImporter $categoryImporter): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$categoryImporter` | **\Fabit\SyliusOdooProductPlugin\Importer\CategoryImporter** |  |





***

### __invoke



```php
public __invoke(\Fabit\SyliusOdooProductPlugin\Message\ImportOdooCategoryMessage $message): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$message` | **\Fabit\SyliusOdooProductPlugin\Message\ImportOdooCategoryMessage** |  |





***


***
> Automatically generated on 2024-02-03
