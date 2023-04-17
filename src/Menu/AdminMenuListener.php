<?php

/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Fab IT Sylius Odoo Product Sync Plugin to newer
 * versions in the future.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://www.fabitsolutions.in/ and write us
 * an email on contact@fabitsolutions.in
 *
 * @category  Fabitsolutions
 * @package   fabit/sylius-odoo-product-plugin
 * @author    contact@fabitsolutions.in
 * @copyright 2023 Fab IT Solutions
 * @license   Open Software License ("OSL") v. 3.0
 */

declare(strict_types=1);

namespace Fabit\SyliusOdooProductPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $odooMenu = $menu
            ->addChild('odoo-management')
            ->setLabel('fabit_sylius_odoo_product.menu.odoo_management.label')
        ;

        $odooMenu
            ->addChild('product-sync', [
                'route' => 'odoo_sync',
                'routeParameters' => ['command' => 'index'],
            ])
            ->setLabel('fabit_sylius_odoo_product.odoo_management.product_sync')
            ->setLabelAttribute('icon', 'refresh')
        ;
    }
}
