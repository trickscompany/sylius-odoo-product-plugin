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

namespace Fabit\SyliusOdooProductPlugin\Importer;

use Fabit\SyliusOdooProductPlugin\Model\Data;
use Fabit\SyliusOdooProductPlugin\Resolver\TaxCategoryResolverInterface;
use Fabit\SyliusOdooProductPlugin\Resolver\TaxRateResolverInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Taxation\Repository\TaxCategoryRepositoryInterface;

final class TaxImporter implements TaxImporterInterface
{
    /** @var TaxCategoryResolverInterface */
    private $taxCategoryResolver;

    /** @var TaxRateResolverInterface */
    private $taxRateResolver;

    /** @var TaxCategoryRepositoryInterface */
    private $taxCategoryRepository;

    public function __construct(
        TaxCategoryResolverInterface $taxCategoryResolver,
        TaxRateResolverInterface $taxRateResolver,
        TaxCategoryRepositoryInterface $taxCategoryRepository
    ) {
        $this->taxCategoryResolver = $taxCategoryResolver;
        $this->taxRateResolver = $taxRateResolver;
        $this->taxCategoryRepository = $taxCategoryRepository;
    }

    public function import(Data $taxData, ZoneInterface $zone): void
    {
        $taxCategory = $this->taxCategoryResolver->resolveByTax($taxData);

        $_taxData = $taxData->getData();
        if (!empty($_taxData['id'])) {
            $taxCategory->setCode((string) $_taxData['id']);
        }
        if (!empty($_taxData['name'])) {
            $taxCategory->setName((string) $_taxData['name']);
        }

        if (!empty($_taxData['description'])) {
            $taxCategory->setDescription((string) $_taxData['description']);
        }

        $this->taxCategoryRepository->add($taxCategory);

        $taxRate = $this->taxRateResolver->resolve($taxCategory, $zone);
        $taxRate->setCategory($taxCategory);
        $taxRate->setZone($zone);
        $taxRate->setCode(Urlizer::urlize(sprintf('%s-%s-%s', $zone->getCode(), $taxCategory->getId(), $taxCategory->getName())));
        $taxRate->setName($zone->getCode() . ' ' . $taxCategory->getName());

        if (!empty($_taxData['amount'])) {
            $taxRate->setAmount(((float) $_taxData['amount']) / 100);
        }

        $taxRate->setIncludedInPrice(true);
        $taxRate->setCalculator('default');

        $this->taxCategoryRepository->add($taxRate);
    }
}
