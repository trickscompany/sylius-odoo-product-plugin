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

namespace Fabit\SyliusOdooProductPlugin\Cli;

use Fabit\SyliusOdooProductPlugin\Message\ImportOdooProductsMessage;
use Fabit\SyliusOdooProductPlugin\Message\ImportOdooTaxesMessage;
use Sylius\Component\Addressing\Model\ZoneInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class ImportProducts extends Command
{
    use ContainerAwareTrait, LockableTrait;

    /** @var MessageBusInterface */
    private $messageBus;

    /** @var string */
    private $locale;

    public function __construct(
        MessageBusInterface $messageBus,
        string              $locale
    ) {
        parent::__construct();

        $this->messageBus = $messageBus;
        $this->locale = $locale;
    }

    protected function configure(): void
    {
        $this->setName('odoo:product:import');
        $this->addArgument('channel', InputArgument::OPTIONAL, 'Local to import category into that');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ChannelRepositoryInterface $channelRepository */
        $channelRepository = $this->container->get('sylius.repository.channel');

        if ($this->isOdooEnabled($output)) {
            /** @var ChannelInterface $channel */
            $channel = null;
            $channelCode = $input->getArgument('channel');
            if (!empty($channelCode)) {
                $channel = $channelRepository->findOneByCode($channelCode);
            }
            
            if (is_null($channel)) {
                $channels = $channelRepository->findAll();
                if (!empty($channels) && count($channels) == 1) {
                    $channel = $channels[0];
                } else {
                    $channel = $channelRepository->findOneByCode('FASHION_WEB');
                }
            }
            
            if (!is_null($channel) && !empty($channel->getId())) {
                $output->writeln(sprintf('<info>Process Start For Channel : ' . $channel->getCode()));
                $this->messageBus->dispatch(new ImportOdooProductsMessage($channel, $this->locale));
            } else {
                $output->writeln(sprintf('<error>Invalid channel provided!</error>'));
                return 0;
            }
        }

        return 0;
    }

    protected function isOdooEnabled(OutputInterface $output): bool
    {
        if ($this->container->getParameter('odoo_enable') !== 'false') {
            return true;
        }
        $output->writeln(sprintf('<info>Please enable Odoo!</info>'));

        return false;
    }
}
