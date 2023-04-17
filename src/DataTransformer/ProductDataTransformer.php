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

namespace Fabit\SyliusOdooProductPlugin\DataTransformer;

use Fabit\SyliusOdooProductPlugin\Model\Product;
use Fabit\SyliusOdooProductPlugin\Model\ProductAttribute;

final class ProductDataTransformer extends DataTransformer
{
    public function transform(array $data): object
    {
        $_data = parent::transform($data);
        $_data = $_data->getData();
        
        //Adjust the array
        
        if (isset($_data['product_tmpl_id'][0])) {
            $_data['product_tmpl_id'] = $_data['product_tmpl_id'][0];
        }
        
        $product = new Product();
        $product->setData($_data);

        //Set attribute
        $optionConfiguration = $this->getOptionConfiguration();
        if (!empty($optionConfiguration['mapping'])) {
            foreach ($optionConfiguration['mapping'] as $mapping) {
                if (isset($mapping['attribute']) && $mapping['attribute'] == true) {
                    if (isset($_data[$mapping['sylius_field']])) {
                        $productAttribute = new ProductAttribute();
                        $productAttribute->code = $mapping['sylius_field'];
                        $productAttribute->type = $mapping['attribute_type'];
                        $productAttribute->value = $_data[$mapping['sylius_field']];

                        $product->addAttributes($productAttribute);
                    }
                }
            }
        }

        return $product;
    }

    /*private function configureOptions(array $optionConfiguration): void
    {
        $this->optionsResolver->setRequired(array_values($optionConfiguration['required']));

        foreach ($optionConfiguration['default'] as $option => $values) {
            $this->optionsResolver->setDefault($option, $values);
        }

        foreach ($optionConfiguration['allowed_types'] as $option => $allowedTypes) {
            $this->optionsResolver->setAllowedTypes($option, $allowedTypes);
        }

        /** @phpstan-ignore-next-line  * /
        $this->optionsResolver->setRequired(array_keys($optionConfiguration['attributes']));
    }*/
}
