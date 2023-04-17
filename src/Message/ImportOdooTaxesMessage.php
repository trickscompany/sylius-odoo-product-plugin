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

namespace Fabit\SyliusOdooProductPlugin\Message;

use Sylius\Component\Addressing\Model\ZoneInterface;

final class ImportOdooTaxesMessage
{
    /** @var ZoneInterface */
    private $zone;

    public function __construct(ZoneInterface $zone)
    {
        $this->zone = $zone;
    }

    public function getZone(): ZoneInterface
    {
        return $this->zone;
    }
}
