***

# ImportCategoris





* Full name: `\Fabit\SyliusOdooProductPlugin\Cli\ImportCategoris`
* Parent class: [`Command`](../../../Symfony/Component/Console/Command/Command.md)



## Properties


### messageBus



```php
private \Symfony\Component\Messenger\MessageBusInterface $messageBus
```






***

## Methods


### __construct



```php
public __construct(\Symfony\Component\Messenger\MessageBusInterface $messageBus): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$messageBus` | **\Symfony\Component\Messenger\MessageBusInterface** |  |





***

### configure



```php
protected configure(): void
```












***

### execute



```php
protected execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output): mixed
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$input` | **\Symfony\Component\Console\Input\InputInterface** |  |
| `$output` | **\Symfony\Component\Console\Output\OutputInterface** |  |





***

### isOdooEnabled



```php
protected isOdooEnabled(\Symfony\Component\Console\Output\OutputInterface $output): bool
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$output` | **\Symfony\Component\Console\Output\OutputInterface** |  |





***


***
> Automatically generated on 2024-02-03
