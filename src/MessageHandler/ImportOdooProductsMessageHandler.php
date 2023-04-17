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

namespace Fabit\SyliusOdooProductPlugin\MessageHandler;

use Doctrine\ORM\EntityManagerInterface;
use Fabit\SyliusOdooProductPlugin\Api\Product\GetProducts;
use Fabit\SyliusOdooProductPlugin\Api\Product\GetProductsCount;
use Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface;
use Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog;
use Fabit\SyliusOdooProductPlugin\Message\ImportOdooProductMessage;
use Fabit\SyliusOdooProductPlugin\Message\ImportOdooProductsMessage;
use Fabit\SyliusOdooProductPlugin\Model\Product;
use Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class ImportOdooProductsMessageHandler implements MessageHandlerInterface
{
    /** @var MessageBusInterface */
    private $messageBus;

    /** @var DataTransformerInterface */
    private $productDataTransformer;

    /** @var GetProductsCount */
    private $getProductsCountService;

    /** @var GetProducts */
    private $getProductsService;

    /** OdooProductPluginLogRepository **/
    private $odooProductPluginLogRepository;

    /** @var LoggerInterface */
    public $logger;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var OdooProductPluginLog */
    private $odooProductPluginLog;

    public function __construct(
        MessageBusInterface $messageBus,
        DataTransformerInterface $productDataTransformer,
        GetProductsCount $getProductsCountService,
        GetProducts $getProductsService,
        OdooProductPluginLogRepositoryInterface $odooProductPluginLogRepository,
        LoggerInterface $logger,
        EntityManagerInterface $entityManager
    ) {
        $this->messageBus = $messageBus;
        $this->productDataTransformer = $productDataTransformer;
        $this->getProductsCountService = $getProductsCountService;
        $this->getProductsService = $getProductsService;
        $this->odooProductPluginLogRepository = $odooProductPluginLogRepository;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function __invoke(ImportOdooProductsMessage $message): void
    {
        $productsCount = $this->loadProductsCount();

        $batchSize = 50;
        for ($i = 0; $i <= $productsCount; $i += $batchSize) {
            /** @var array[] $odooProducts */
            $odooProducts = $this->loadProducts($i, min($batchSize, $productsCount - $i));

            //Began the transaction
            $this->entityManager->beginTransaction();

            foreach ($odooProducts as $odooProduct) {
                /** @var Product $product */
                $product = $this->productDataTransformer->transform($odooProduct);

                $this->messageBus->dispatch(new ImportOdooProductMessage($product, $message->getChannel(), $message->getLocale()));
            }

            $this->entityManager->flush();

            if ($this->entityManager->getConnection()->isTransactionActive()) {
                $this->entityManager->commit();
            }
        }

        if ($productsCount > 0) {
            $this->updateLastSync();
        }
    }

    private function loadProducts(int $offset, int $limit): array
    {
        $this->setFilter();

        /** @var array $data */
        $data = $this->getProductsService->getData($offset, $limit);

        return $data;
    }

    private function loadProductsCount(): int
    {
        $this->setFilter();

        /** @var int $count */
        $count = $this->getProductsCountService->getData();

        $this->debug('Total Products return API: ' . $count);

        return $count;
    }

    private function setFilter()
    {
        $this->odooProductPluginLog = $this->odooProductPluginLogRepository->getOdooProductPluginLog('product.product');
        //Set last update date in filter
        if (null !== $this->odooProductPluginLog && null !== $this->odooProductPluginLog->getLastSyncDate()) {
            $this->getProductsService->addStringFilter('write_date', '>', $this->odooProductPluginLog->getLastSyncDate()->format('Y-m-d H:i:s'));
            $this->getProductsCountService->addStringFilter('write_date', '>', $this->odooProductPluginLog->getLastSyncDate()->format('Y-m-d H:i:s'));
        }
    }

    private function updateLastSync()
    {
        if (!$this->odooProductPluginLog instanceof OdooProductPluginLog) {
            $this->odooProductPluginLog = new OdooProductPluginLog();
            $this->odooProductPluginLog->setCode('product.product');
        }

        $this->odooProductPluginLogRepository->updateWriteDate($this->odooProductPluginLog);
    }

    private function debug(string $message, array $data = []): void
    {
        $this->logger->debug('[' . self::class . '] ' . $message, $data);
    }
}
