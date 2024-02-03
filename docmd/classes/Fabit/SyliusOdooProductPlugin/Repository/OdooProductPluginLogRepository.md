***

# OdooProductPluginLogRepository





* Full name: `\Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepository`
* Parent class: [`ServiceEntityRepository`](../../../Doctrine/Bundle/DoctrineBundle/Repository/ServiceEntityRepository.md)
* This class implements:
[`\Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface`](./OdooProductPluginLogRepositoryInterface.md)




## Methods


### __construct



```php
public __construct(\Doctrine\Persistence\ManagerRegistry $registry): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$registry` | **\Doctrine\Persistence\ManagerRegistry** |  |





***

### save



```php
public save(\Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog $entity): ?\Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$entity` | **\Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog** |  |




**Throws:**

- [`ORMException`](../../../Doctrine/ORM/ORMException.md)

- [`OptimisticLockException`](../../../Doctrine/ORM/OptimisticLockException.md)



***

### getOdooProductPluginLog

This function return last updated date for api call by code

```php
public getOdooProductPluginLog(string $code): ?\Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$code` | **string** |  |





***

### updateWriteDate

This function save the last write date to current date time and save into DB

```php
public updateWriteDate(\Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog $entity): ?\Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$entity` | **\Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog** |  |





***


***
> Automatically generated on 2024-02-03
