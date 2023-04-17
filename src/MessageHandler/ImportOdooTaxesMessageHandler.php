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

use Fabit\SyliusOdooProductPlugin\Api\Tax\GetTax;
use Fabit\SyliusOdooProductPlugin\Api\Tax\GetTaxCount;
use Fabit\SyliusOdooProductPlugin\DataTransformer\DataTransformerInterface;
use Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog;
use Fabit\SyliusOdooProductPlugin\Message\ImportOdooTaxesMessage;
use Fabit\SyliusOdooProductPlugin\Message\ImportOdooTaxMessage;
use Fabit\SyliusOdooProductPlugin\Repository\OdooProductPluginLogRepositoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class ImportOdooTaxesMessageHandler implements MessageHandlerInterface
{
    /** @var MessageBusInterface */
    private $messageBus;

    /** @var DataTransformerInterface */
    private $taxDataTransformer;

    /** @var GetTax */
    private $getTaxesService;

    /** @var GetTaxCount */
    private $getTaxesCountService;

    /** OdooProductPluginLogRepository **/
    private $odooProductPluginLogRepository;

    /** @var LoggerInterface */
    public $logger;

    /** @var OdooProductPluginLog */
    private $odooProductPluginLog;

    public function __construct(
        MessageBusInterface $messageBus,
        DataTransformerInterface $taxDataTransformer,
        GetTaxCount $getTaxesCountService,
        GetTax $getTaxesService,
        OdooProductPluginLogRepositoryInterface $odooProductPluginLogRepository,
        LoggerInterface $logger
    ) {
        $this->messageBus = $messageBus;
        $this->taxDataTransformer = $taxDataTransformer;
        $this->getTaxesCountService = $getTaxesCountService;
        $this->getTaxesService = $getTaxesService;
        $this->odooProductPluginLogRepository = $odooProductPluginLogRepository;
        $this->logger = $logger;
    }

    public function __invoke(ImportOdooTaxesMessage $message): void
    {
        $taxesCount = $this->loadTaxesCount();

        $batchSize = 50;
        for ($i = 0; $i <= $taxesCount; $i += $batchSize) {
            $odooTaxes = $this->loadTaxes($i, min($batchSize, $taxesCount - $i));

            foreach ($odooTaxes as $odooTax) {
                $taxData = $this->taxDataTransformer->transform($odooTax);
                $this->messageBus->dispatch(new ImportOdooTaxMessage($taxData, $message->getZone()));
            }
        }

        if ($taxesCount > 0) {
            $this->updateLastSync();
        }
    }

    private function loadTaxes(int $offset, int $limit): array
    {
        $this->setFilter();

        /** @var array $data */
        $data = $this->getTaxesService->getData($offset, $limit);

        return $data;
    }

    private function loadTaxesCount(): int
    {
        $this->setFilter();

        /** @var int $count */
        $count = $this->getTaxesCountService->getData();

        $this->debug('Total Taxes return API: ' . $count);

        return $count;
    }

    private function setFilter()
    {
        $this->odooProductPluginLog = $this->odooProductPluginLogRepository->getOdooProductPluginLog('product.tax');
        //Set last update date in filter
        if (null !== $this->odooProductPluginLog && null !== $this->odooProductPluginLog->getLastSyncDate()) {
            $this->getTaxesService->addStringFilter('write_date', '>', $this->odooProductPluginLog->getLastSyncDate()->format('Y-m-d H:i:s'));
            $this->getTaxesCountService->addStringFilter('write_date', '>', $this->odooProductPluginLog->getLastSyncDate()->format('Y-m-d H:i:s'));
        }
    }

    private function updateLastSync()
    {
        if (!$this->odooProductPluginLog instanceof OdooProductPluginLog) {
            $this->odooProductPluginLog = new OdooProductPluginLog();
            $this->odooProductPluginLog->setCode('product.tax');
        }

        $this->odooProductPluginLogRepository->updateWriteDate($this->odooProductPluginLog);
    }

    private function debug(string $message, array $data = []): void
    {
        $this->logger->debug('[' . self::class . '] ' . $message, $data);
    }
}
