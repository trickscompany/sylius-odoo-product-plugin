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

use Fabit\SyliusOdooProductPlugin\Model\Data;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DataTransformer implements DataTransformerInterface
{
    /** @var OptionsResolver */
    private $optionsResolver;

    /** @var array */
    private $optionConfiguration;

    public function __construct(array $optionConfiguration)
    {
        $this->optionsResolver = new OptionsResolver();

        $this->optionConfiguration = $optionConfiguration;

        $this->configureOptions($optionConfiguration);
    }

    public function transform(array $data): object
    {
        $data = $this->optionsResolver->resolve($data);

        $item = new Data();
        $item->setData($data);

        return $item;
    }

    public function getOptionConfiguration(): array
    {
        return $this->optionConfiguration;
    }

    private function configureOptions(array $optionConfiguration): void
    {
        $this->setRequired($optionConfiguration);
        $this->setDefault($optionConfiguration);
        $this->setAllowedTypes($optionConfiguration);
    }

    private function setRequired(array $optionConfiguration): void
    {
        $requiredList = [];

        if (!empty($optionConfiguration['mapping'])) {
            foreach ($optionConfiguration['mapping'] as $option) {
                if (!empty($option['required']) && ($option['required'] == true || $option['required'] == 1)) {
                    if (!empty($option['odoo_field'])) {
                        $requiredList[] = $option['odoo_field'];
                    }
                }
            }
        }

        $this->optionsResolver->setRequired(array_values($requiredList));
    }

    private function setDefault(array $optionConfiguration): void
    {
        $defaultList = [];

        if (!empty($optionConfiguration['mapping'])) {
            foreach ($optionConfiguration['mapping'] as $option) {
                if (isset($option['default'])) {
                    if (!empty($option['odoo_field'])) {
                        $defaultList[$option['odoo_field']] = $option['default'];
                    }
                }
            }
        }

        foreach ($defaultList as $option => $values) {
            $this->optionsResolver->setDefault($option, $values);
        }
    }

    private function setAllowedTypes(array $optionConfiguration): void
    {
        $allowedTypesList = [];

        if (!empty($optionConfiguration['mapping'])) {
            foreach ($optionConfiguration['mapping'] as $option) {
                if (isset($option['allowed_types'])) {
                    if (!empty($option['odoo_field'])) {
                        $defaultList[$option['odoo_field']] = $option['allowed_types'];
                    }
                }
            }
        }

        foreach ($allowedTypesList as $option => $allowedTypes) {
            $this->optionsResolver->setAllowedTypes($option, $allowedTypes);
        }
    }
}
