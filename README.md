<p align="center">
    <a href="https://www.fabitsolutions.in/r/knk" target="_blank">
        <img src="https://www.fabitsolutions.in/web/image/website/1/logo/Fab%20IT%20Solutions" width="150"  />
    </a>
</p>

<h1 align="center">Fabit Odoo Product Plugin Skeleton</h1>
This plugin sync Odoo products into Sylius

## Documentation

For a comprehensive guide on Sylius plugin development please go to Sylius documentation,
there you will find the <a href="https://docs.sylius.com/en/latest/plugin-development-guide/index.html">Plugin Development Guide</a>, that is full of examples.

## Quickstart Installation

- Create new file [project]/]config/packages/sylius_odoo_product.yaml and copy configuraiton into it

```yaml
sylius_odoo_product:
    data_transform:
        product:
            mapping:
                -
                    sylius_field: id
                    odoo_field: id
                    required: true
                    default: ''
                    allow_types: [int, 'null']
                -
                    sylius_field: productTmplId
                    odoo_field: product_tmpl_id
                    required: true
                    default: ''
                    allow_types: [int, 'null']
                -
                    sylius_field: code
                    odoo_field: code
                    required: true
                    default: ''
                    allow_types: [string, 'null']
                -
                    sylius_field: name
                    odoo_field: name
                    required: true
                    default: ''
                    allow_types: [string, 'null']
                -
                    sylius_field: description
                    odoo_field: description
                    required: true
                    default: ''
                    allow_types: [string, 'null']
                -
                    sylius_field: categId
                    odoo_field: categ_id
                    required: false
                    default: [ ]
                    allow_types: [array]
                -
                    sylius_field: lst_price
                    odoo_field: lst_price
                    required: true
                    default: ''
                    allow_types: [float]
                -
                    sylius_field: taxes_id
                    odoo_field: taxes_id
                    required: false
                    default: [ ]
                    allow_types: [array]
                -
                    sylius_field: image1920
                    odoo_field: image_1920
                    required: true
                    default: null
                    allow_types: [string, boolean, 'null']
                -
                    sylius_field: active
                    odoo_field: active
                    required: true
                    default: null
                    allow_types: [string, boolean, 'null']

        tax:
            mapping:
                -
                    sylius_field: code
                    odoo_field: id
                    required: true
                    default: ''
                    allow_types: [string, 'null']
                -
                    sylius_field: name
                    odoo_field: name
                    required: true
                    default: ''
                    allow_types: [string, 'null']
                -
                    sylius_field: description
                    odoo_field: description
                    required: true
                    default: ''
                    allow_types: [string, 'null', 'bool']
                -
                    sylius_field: amount
                    odoo_field: amount
                    required: true
                    default: ''
                    allow_types: [float, 'null']
        category:
            mapping:
                -
                    sylius_field: code
                    odoo_field: id
                    required: true
                    default: ''
                    allow_types: [string, 'null']
                -
                    sylius_field: name
                    odoo_field: name
                    required: true
                    default: ''
                    allow_types: [string, 'null']
                -
                    sylius_field: parent
                    odoo_field: parent_id
                    required: true
                    default: ''
                    allow_types: [string, 'null']


```

- Run composer to add dependancy

  `composer require fabit/sylius-odoo-product-plugin`

- Add following entry in ```config/bundles.php```

  `Fabit\SyliusOdooProductPlugin\SyliusOdooProductPlugin::class => ['all' => true]`

- Add route entry in ```config/routes.yaml```

```yaml
fabit_sylius_odoo_product_plugin:
    resource: "@SyliusOdooProductPlugin/Resources/config/routing.yaml"
```

- Override the Product Entity ```src/Entity/Product/Product.php```, Add ProductTrait to your Product entity

```php
namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductTranslationInterface;
use Fabit\SyliusOdooProductPlugin\Traits\ProductTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product", indexes={
 *      @ORM\Index(name="sylius_odoo_product_plugin_odoo_product_tmpl_id", columns={"odoo_product_tmpl_id"})
 * })
 */
class Product extends BaseProduct
{
    use ProductTrait;
```

- Override the ProductVariant Entity ```src/Entity/Product/ProductVariant.php```, Add ProductVariantTrait to your ProductVariant entity

```php
namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ProductVariant as BaseProductVariant;
use Sylius\Component\Product\Model\ProductVariantTranslationInterface;
use Fabit\SyliusOdooProductPlugin\Traits\ProductVariantTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product_variant", indexes={
 *      @ORM\Index(name="sylius_odoo_product_plugin_odoo_product_variant_id", columns={"odoo_product_variant_id"})
 * })
 */
class ProductVariant extends BaseProductVariant
{
    use ProductVariantTrait;

```

- Add following variables in .env file

  ```
  ###> fabit/sylius-odoo-product-plugin ###
  odoo_url=https://demo.odoo.com
  odoo_db=odoo-datbase
  odoo_user=odoo-user
  odoo_password=odoo-password
  odoo_live_stock=True
  odoo_enable=1
  ###> fabit/sylius-odoo-product-plugin ###
  ```

### Sylius basic intallation
- Run following command to install install Sylius
    `php bin/console sylius:install`
    - note: on a demo Odoo, use `en_EN` as localization

- Make sure media directory has write permission

- Setup Country & Zone

```sql
INSERT INTO `sylius_country` (`id`, `code`, `enabled`) VALUES
(NULL, 'FR', 1);
INSERT INTO `sylius_zone` (`id`, `code`, `name`, `type`, `scope`) VALUES
(NULL, 'FR', 'France', 'country', 'all');
INSERT INTO `sylius_zone_member` (`id`, `belongs_to`, `code`) VALUES
(NULL, 1, 'FR');
```
### Execute Odoo commands
- Update database table, Run command to update database schema

  `php bin/console doctrine:schema:update --force`

- Run following command to import all categories

  `php bin/console odoo:category:import`

- Run following command to import all taxes

  `php bin/console odoo:tax:import`

- Run following command to import all taxes

  `php bin/console odoo:product:import`

### Sylius after Odoo Sync

- Choose Odoo category "All" in Configuration -> Channel
- Choose Delivery method
- Choose Payment method

**_! ENJOY THE DEMO !_**