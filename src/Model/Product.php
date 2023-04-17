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

namespace Fabit\SyliusOdooProductPlugin\Model;

class Product extends Data
{
    /** @var ProductAttribute[] */
    private $_attributes = [];

    public function addAttributes(ProductAttribute $productAttribute): self
    {
        if (empty($this->_attributes)) {
            $this->_attributes = [];
        }

        $this->_attributes[] = $productAttribute;

        return $this;
    }

    public function setAttributes(array $attributes): self
    {
        $this->_attributes = $attributes;

        if (empty($this->_attributes)) {
            $this->_attributes = [];
        }

        return $this;
    }

    public function getAttributes(): array
    {
        return $this->_attributes;
    }

    public function getId(): ? int
    {
        $_data = $this->getData();
        if (isset($_data['id'])) {
            if (is_bool($_data['id'])) {
                return null;
            }

            return $_data['id'];
        }

        return null;
    }
    
    public function getProductTmplId(): ? int
    {
        $_data = $this->getData();
        if (isset($_data['product_tmpl_id'])) {
            if (is_bool($_data['product_tmpl_id'])) {
                return null;
            }
            
            return $_data['product_tmpl_id'];
        }
        
        return null;
    }

    public function getCode(): string
    {
        $_data = $this->getData();
        
        if (empty($_data['code'])) {
            $_data['code'] = '' . $_data['id'];
        }
        
        if (isset($_data['code'])) {
            if (is_bool($_data['code'])) {
                return '';
            }

            return $_data['code'];
        }

        return '';
    }
    
    public function getImag1920(): string
    {
        $_data = $this->getData();
        
        if (isset($_data['image_1920'])) {
            if (is_bool($_data['image_1920'])) {
                return '';
            }
            
            return $_data['image_1920'];
        }
        
        return '';
    }

    public function getName(): string
    {
        $_data = $this->getData();
        if (isset($_data['name'])) {
            return $_data['name'];
        }

        return '';
    }

    public function getDescription()
    {
        $_data = $this->getData();
        if (isset($_data['description'])) {
            return $_data['description'];
        }

        return '';
    }
    
    public function isActive(): bool
    {
        $_data = $this->getData();
        if (isset($_data['active'])) {
            return (bool)$_data['active'];
        }
        
        return false;
    }

    public function getDataValue(string $key): string
    {
        $_data = $this->getData();
        if (isset($_data[$key])) {
            return $_data[$key];
        }

        return '';
    }
}
