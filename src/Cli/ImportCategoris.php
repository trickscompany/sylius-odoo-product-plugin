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

use Fabit\SyliusOdooProductPlugin\Message\ImportOdooCategorisMessage;
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

class ImportCategoris extends Command
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
        $this->setName('odoo:category:import');
        $this->addArgument('locale', InputArgument::OPTIONAL, 'Local to import category into that');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var RepositoryInterface $localRepository */
        $localRepository = $this->container->get('sylius.repository.locale');
        
        $localeCode = $input->getArgument('locale');
        if (!empty($localeCode)) {
            $locale = $localRepository->findOneByCode($localeCode);
            if (!is_null($locale) && !empty($locale->getId())) {
                $this->locales = [$locale->getCode()];
            }
        }

        if ($this->isOdooEnabled($output)) {
            if (empty($this->locales)) {
                $localeList = $localRepository->findAll();
                foreach ($localeList as $locale) {
                    if (!is_null($locale) && !empty($locale->getId())) {
                        $this->locales[] = $locale->getCode();
                    }
                }
            }
            
            if (empty($this->locales)) {
                $output->writeln(sprintf('<error>Invalid locale configration. Please define locales configuration !</error>'));
                return 0;
            }
            
            $isLocalFound = false;
            if (!empty($this->locales)) {
                $isLocalFound = true;
                foreach ($this->locales as $locale) {
                    $this->messageBus->dispatch(new ImportOdooCategorisMessage($locale));
                }
            }
            
            if ($isLocalFound != true) {
                $output->writeln(sprintf('<error>Invalid locale provided!</error>'));
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
