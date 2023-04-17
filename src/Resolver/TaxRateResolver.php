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

namespace Fabit\SyliusOdooProductPlugin\Resolver;

use Gedmo\Sluggable\Util\Urlizer;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Core\Model\TaxRateInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxation\Model\TaxCategoryInterface;

final class TaxRateResolver implements TaxRateResolverInterface
{
    /** @var RepositoryInterface */
    private $taxRateRepository;

    /** @var FactoryInterface */
    private $taxRateFactory;

    public function __construct(RepositoryInterface $taxRateRepository, FactoryInterface $taxRateFactory)
    {
        $this->taxRateRepository = $taxRateRepository;
        $this->taxRateFactory = $taxRateFactory;
    }

    public function resolve(TaxCategoryInterface $taxCategory, ZoneInterface $zone): TaxRateInterface
    {
        $taxRate = $this->taxRateRepository->findOneBy(
            [
                'code' => Urlizer::urlize(sprintf('%s-%s-%s', $zone->getCode(), $taxCategory->getId(), $taxCategory->getName())),
            ]
        );

        if (!$taxRate instanceof TaxRateInterface) {
            /** @var TaxRateInterface $taxRate */
            $taxRate = $this->taxRateFactory->createNew();
        }

        return $taxRate;
    }
}
