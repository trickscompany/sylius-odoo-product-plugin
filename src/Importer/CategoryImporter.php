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

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Sylius\Component\Core\Formatter\StringInflector;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Taxonomy\Factory\TaxonFactoryInterface;
use Sylius\Component\Taxonomy\Generator\TaxonSlugGeneratorInterface;
use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;

final class CategoryImporter implements CategoryImporterInterface
{
    /** @var TaxonFactoryInterface */
    private $taxonFactory;

    /** @var TaxonRepositoryInterface */
    private $taxonRepository;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var TaxonSlugGeneratorInterface */
    private $taxonSlugGenerator;

    /** @var LoggerInterface */
    public $logger;

    public function __construct(
        TaxonFactoryInterface $taxonFactory,
        TaxonRepositoryInterface $taxonRepository,
        EntityManagerInterface $entityManager,
        TaxonSlugGeneratorInterface $taxonSlugGenerator,
        LoggerInterface $logger
    ) {
        $this->taxonFactory = $taxonFactory;
        $this->taxonRepository = $taxonRepository;
        $this->entityManager = $entityManager;
        $this->taxonSlugGenerator = $taxonSlugGenerator;
        $this->logger = $logger;
    }

    public function import(array $data, string $locale): void
    {
        try {
            $taxons = [];

            //Began the transaction
            $this->entityManager->beginTransaction();

            $this->debug('Total Categories: ' . count($data));
            foreach ($data as $dataObject) {
                $categoryData = $dataObject->getData();

                //Check if category is already exist
                $taxon = $this->taxonRepository->findOneBy(['code' => (string) $categoryData['id']]);

                if ($taxon instanceof TaxonInterface) {
                    $taxons[$taxon->getCode()] = $taxon;
                }

                $parentTaxon = null;
                if (isset($taxons[$categoryData['parent_id']])) {
                    $parentTaxon = $taxons[$categoryData['parent_id']];
                } elseif (!empty($categoryData['parent_id'])) {
                    $parentTaxon = $this->taxonRepository->findOneBy(['code' => (string) $categoryData['parent_id']]);
                    $taxons[$parentTaxon->getCode()] = $parentTaxon;
                }

                if (!$taxon instanceof TaxonInterface) {
                    $taxon = $this->createTaxon((string) $categoryData['id'], $categoryData['name'], $locale);
                    $this->taxonRepository->add($taxon);
                }

                if ($taxon instanceof TaxonInterface) {
                    if ($parentTaxon instanceof TaxonInterface) {
                        //Set parent
                        $taxon->setParent($parentTaxon);
                    }

                    $taxon->setCurrentLocale($locale);
                    $taxon->setFallbackLocale($locale);
                    $taxon->setName($categoryData['name']);
                    $taxon->setSlug((string) $categoryData['id'] . '-' . $this->taxonSlugGenerator->generate($taxon, $locale));

                    //Add or edit taxon
                    $this->taxonRepository->add($taxon);

                    $this->debug('Taxon Created: ', [
                        'id' => $taxon->getId(),
                        'code' => $taxon->getCode(),
                        'name' => $taxon->getName(),
                        'slug' => $taxon->getSlug(),
                        'locale' => $locale,
                    ]);
                }
            }

            $this->entityManager->flush();

            if ($this->entityManager->getConnection()->isTransactionActive()) {
                $this->entityManager->commit();
            }
        } catch (\Exception $e) {
            if ($this->entityManager->getConnection()->isTransactionActive()) {
                $this->entityManager->rollback();
            }

            throw $e;
        }
    }

    private function createTaxon($code, $name, $locale): TaxonInterface
    {
        /** @var TaxonInterface $taxon */
        $taxon = $this->taxonFactory->createNew();

        $taxon->setCode(StringInflector::nameToLowercaseCode($code));

        return $taxon;
    }

    private function debug(string $message, array $data = [], bool $isEcho = false): void
    {
        if ($isEcho) {
            echo '[' . self::class . '] ' . $message . ' ' . (!empty($data) && is_array($data)) ? json_encode($data) : [];
            echo "\n";
        }

        $this->logger->debug('[' . self::class . '] ' . $message, $data);
    }
}
