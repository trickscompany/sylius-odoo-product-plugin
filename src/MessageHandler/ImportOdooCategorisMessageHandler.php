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

use Fabit\SyliusOdooProductPlugin\Api\Category\GetCategory;
use Fabit\SyliusOdooProductPlugin\Api\Category\GetCategoryCount;
use Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface;
use Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog;
use Fabit\SyliusOdooProductPlugin\Message\ImportOdooCategorisMessage;
use Fabit\SyliusOdooProductPlugin\Message\ImportOdooCategoryMessage;
use Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepository;
use Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class ImportOdooCategorisMessageHandler implements MessageHandlerInterface
{
    /** @var MessageBusInterface */
    private $messageBus;

    /** @var DataTransformerInterface */
    private $categoryDataTransformer;

    /** @var GetCategory */
    private $getCategoryService;

    /** @var GetCategoryCount */
    private $getCategoryCountService;

    /** OdooProductPluginLogRepository **/
    private $odooProductPluginLogRepository;

    /** @var LoggerInterface */
    public $logger;

    /** @var OdooProductPluginLog */
    private $odooProductPluginLog;

    public function __construct(
        MessageBusInterface $messageBus,
        DataTransformerInterface $categoryDataTransformer,
        GetCategoryCount $getCategoryCountService,
        GetCategory $getCategoryService,
        OdooProductPluginLogRepositoryInterface $odooProductPluginLogRepository,
        LoggerInterface $logger
    ) {
        $this->messageBus = $messageBus;
        $this->categoryDataTransformer = $categoryDataTransformer;
        $this->getCategoryCountService = $getCategoryCountService;
        $this->getCategoryService = $getCategoryService;
        $this->odooProductPluginLogRepository = $odooProductPluginLogRepository;
        $this->logger = $logger;
    }

    public function __invoke(ImportOdooCategorisMessage $message): void
    {
        $categoryCount = $this->loadCategoryCount();

        $batchSize = 50;
        for ($i = 0; $i <= $categoryCount; $i += $batchSize) {
            /** @var array[] $odooCategoryList */
            $odooCategoryList = $this->loadCategories($i, min($batchSize, $categoryCount - $i));

            $caegoryDataList = [];
            foreach ($odooCategoryList as $odooCategory) {
                $caegoryDataList[] = $this->categoryDataTransformer->transform($odooCategory);
            }

            $this->messageBus->dispatch(new ImportOdooCategoryMessage($caegoryDataList, $message->getLocal()));
        }

        if ($categoryCount > 0) {
            $this->updateLastSync();
        }
    }

    private function loadCategories(int $offset, int $limit): array
    {
        $this->setFilter();

        /** @var array $data */
        $data = $this->getCategoryService->getData($offset, $limit);

        return $data;
    }

    private function loadCategoryCount(): int
    {
        $this->setFilter();

        /** @var int $count */
        $count = $this->getCategoryCountService->getData();

        $this->debug('Total Categories return API: ' . $count);

        return $count;
    }

    private function setFilter()
    {
        $this->odooProductPluginLog = $this->odooProductPluginLogRepository->getOdooProductPluginLog('product.category');
        //Set last update date in filter
        if (null !== $this->odooProductPluginLog && null !== $this->odooProductPluginLog->getLastSyncDate()) {
            $this->getCategoryService->addStringFilter('write_date', '>', $this->odooProductPluginLog->getLastSyncDate()->format('Y-m-d H:i:s'));
            $this->getCategoryCountService->addStringFilter('write_date', '>', $this->odooProductPluginLog->getLastSyncDate()->format('Y-m-d H:i:s'));
        }
    }

    private function updateLastSync()
    {
        if (!$this->odooProductPluginLog instanceof OdooProductPluginLog) {
            $this->odooProductPluginLog = new OdooProductPluginLog();
            $this->odooProductPluginLog->setCode('product.category');
        }

        $this->odooProductPluginLogRepository->updateWriteDate($this->odooProductPluginLog);
    }

    private function debug(string $message, array $data = []): void
    {
        $this->logger->debug('[' . self::class . '] ' . $message, $data);
    }
}
