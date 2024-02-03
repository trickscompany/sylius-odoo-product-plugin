***

# TaxCategoryResolverInterface





* Full name: `\Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface`



## Methods


### resolveByTax



```php
public resolveByTax(\Fabit\SyliusOdooProductPlugin\Model\Data $taxData): \Sylius\Component\Taxation\Model\TaxCategoryInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$taxData` | **\Fabit\SyliusOdooProductPlugin\Model\Data** |  |





***

### resolveByProduct



```php
public resolveByProduct(\Sylius\Component\Core\Model\ProductInterface $syliusProduct, \Fabit\SyliusOdooProductPlugin\Model\Product $product): ?\Sylius\Component\Taxation\Model\TaxCategoryInterface
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$syliusProduct` | **\Sylius\Component\Core\Model\ProductInterface** |  |
| `$product` | **\Fabit\SyliusOdooProductPlugin\Model\Product** |  |





***


***
> Automatically generated on 2024-02-03
