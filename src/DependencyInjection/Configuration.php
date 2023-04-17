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

namespace Fabit\SyliusOdooProductPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('sylius_odoo_product');

        $rootNode = $treeBuilder->getRootNode();
        /** @phpstan-ignore-next-line  */
        /*$rootNode
            ->children()
            ->arrayNode('data_transform')
                ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->children()
                            ->arrayNode('required')
                                ->performNoDeepMerging()
                                    ->scalarPrototype()
                                ->end()
                            ->end()

                            ->arrayNode('default')
                                ->useAttributeAsKey('name')
                                    ->performNoDeepMerging()->variablePrototype()
                                ->end()
                            ->end()

                            ->arrayNode('allowed_types')
                                ->useAttributeAsKey('name')
                                    ->performNoDeepMerging()
                                        ->variablePrototype()
                                ->end()
                            ->end()

                            ->arrayNode('attributes')
                                ->useAttributeAsKey('name')
                                    ->performNoDeepMerging()->variablePrototype()
                                ->end()
                            ->end();
        */

        $rootNode
            ->children()
                ->arrayNode('data_transform')
                    ->useAttributeAsKey('name')
                        ->arrayPrototype()
                            ->children()
                                ->arrayNode('mapping')
                                        ->performNoDeepMerging()->variablePrototype()

                                ->end()
                            ->end()
                        ->end();

        return $treeBuilder;
    }
}
