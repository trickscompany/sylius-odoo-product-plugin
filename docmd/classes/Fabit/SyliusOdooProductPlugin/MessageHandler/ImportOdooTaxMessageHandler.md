***

# ImportOdooTaxMessageHandler





* Full name: `\Fabit\SyliusOdooProductPlugin\MessageHandler\ImportOdooTaxMessageHandler`
* This class is marked as **final** and can't be subclassed
* This class implements:
[`\Symfony\Component\Messenger\Handler\MessageHandlerInterface`](../../../Symfony/Component/Messenger/Handler/MessageHandlerInterface.md)
* This class is a **Final class**



## Properties


### taxImporter



```php
private \Fabit\SyliusOdooProductPlugin\Importer\TaxImporterInterface $taxImporter
```






***

## Methods


### __construct



```php
public __construct(\Fabit\SyliusOdooProductPlugin\Importer\TaxImporterInterface $taxImporter): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$taxImporter` | **\Fabit\SyliusOdooProductPlugin\Importer\TaxImporterInterface** |  |





***

### __invoke



```php
public __invoke(\Fabit\SyliusOdooProductPlugin\Message\ImportOdooTaxMessage $message): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$message` | **\Fabit\SyliusOdooProductPlugin\Message\ImportOdooTaxMessage** |  |





***


***
> Automatically generated on 2024-02-03
