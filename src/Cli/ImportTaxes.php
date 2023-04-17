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

class ImportTaxes extends Command
{
    use ContainerAwareTrait, LockableTrait;

    /** @var MessageBusInterface */
    private $messageBus;

    public function __construct(
        MessageBusInterface $messageBus
    ) {
        parent::__construct();

        $this->messageBus = $messageBus;
    }

    protected function configure(): void
    {
        $this->setName('odoo:tax:import');
        $this->addArgument('zone', InputArgument::OPTIONAL, 'Zone to import taxes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $zoneCode = $input->getArgument('zone');
        if ($this->isOdooEnabled($output)) {
            /** @var RepositoryInterface $zoneRepository */
            $zoneRepository = $this->container->get('sylius.repository.zone');
            
            /** @var ZoneInterface $zone */
            $zone = null;
            if (!empty($zoneCode)) {
                $zone = $zoneRepository->findOneBy(['code' => $zoneCode]);
            }
            if (is_null($zone)) {
                //Right now consider the first zone only
                $zones = $zoneRepository->findAll();
                if (!empty($zones) && count($zones) > 0) {
                    $zone = $zones[0];
                } else {
                    $output->writeln(sprintf('<error>Invalid zone or zone not found!</error>'));
                    return 0;
                }
            }
            
            if (!is_null($zone) && !empty($zone->getId())) {
                $this->messageBus->dispatch(new ImportOdooTaxesMessage($zone));
            } else {
                $output->writeln(sprintf('<error>Invalid zone code provided!</error>'));
                return 0;
            }
        }
        
        $output->writeln(sprintf('<info>Command executed successfully!</info>'));

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
