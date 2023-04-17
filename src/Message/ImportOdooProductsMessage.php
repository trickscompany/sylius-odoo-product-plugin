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

use Sylius\Component\Core\Model\ChannelInterface;

final class ImportOdooProductsMessage
{
    /** @var ChannelInterface */
    private $channel;

    /** @var string */
    private $locale;

    public function __construct(
        ChannelInterface $channel,
        string $locale
    ) {
        $this->channel = $channel;
        $this->locale = $locale;
    }

    public function getChannel(): ChannelInterface
    {
        return $this->channel;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }
}
