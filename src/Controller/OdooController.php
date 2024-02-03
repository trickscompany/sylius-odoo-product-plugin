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

namespace Fabit\SyliusOdooProductPlugin\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;

/**
* Controller Odoo Import
*/
final class OdooController extends AbstractController
{
    /** @var Environment */
    private $twig;

    public function __construct(
        Environment $twig
    ) {
        $this->twig = $twig;
    }

    public function __invoke(Request $request): Response
    {
        $responseParams = [];

        //Render all command list
        $responseParams['commands'] = [];

        //Add command for category to taxon sync
        $responseParams['commands']['category'] = [
            'name' => 'fabit_sylius_odoo_product.odoo_management.category_sync',
        ];

        //Add tax command
        $responseParams['commands']['tax'] = [
            'name' => 'fabit_sylius_odoo_product.odoo_management.tax_sync',
        ];

        //Add product command
        $responseParams['commands']['product'] = [
            'name' => 'fabit_sylius_odoo_product.odoo_management.product_sync',
        ];

        $command = (string) $request->attributes->get('command', '');
        if (!empty($command)) {
            $output = $this->handleCommand($request, $command);

            //Set output for UI
            if (isset($responseParams['commands'][$command])) {
                $responseParams['commands'][$command]['output'] = $output;
            }
        }

        return new Response($this->twig->render('@SyliusOdooProductPlugin/odoo_sync.html.twig', $responseParams));
    }

    private function handleCommand(Request $request, string $command): array
    {
        define('STDIN', fopen('php://stdin', 'r'));

        $responseContent = [];
        switch ($command) {
            case 'category':
                /*$defaultLocals = ['fr_FR', 'en_EN'];
                 $locale = (string) $request->attributes->get('locale', '');
                 if (!empty($locale)) {
                 $responseContent[$locale] = $this->runCategoryImportCommand($request, $locale);
                 } else {
                 foreach ($defaultLocals as $locale) {
                 $responseContent[$locale] = $this->runCategoryImportCommand($request, $locale);
                 }
                 }*/
                
                $responseContent[] = $this->runCategoryImportCommand($request);

                break;
            case 'tax':
                /*$defaultZones = ['WORLD'];
                 $zone = (string) $request->attributes->get('zone', '');
                 if (!empty($zone)) {
                 $responseContent[$zone] = $this->runTaxImportCommand($request, $zone);
                 } else {
                 foreach ($defaultZones as $zone) {
                 $responseContent[$zone] = $this->runTaxImportCommand($request, $zone);
                 }
                 }*/
                
                $responseContent[] = $this->runTaxImportCommand($request);

                break;
            case 'product':
                $responseContent[] = $this->runProductImportCommand($request);

                break;
            default: $responseContent = [];

break;
        }

        return $responseContent;
    }

    private function runProductImportCommand(Request $request, string $channelCode = ''): string
    {
        return $this->runCommand('odoo:product:import');
    }

    private function runTaxImportCommand(Request $request, string $zone = ''): string
    {
        return $this->runCommand('odoo:tax:import');
    }

    private function runCategoryImportCommand(Request $request, string $locale = ''): string
    {
        return $this->runCommand('odoo:category:import');
    }

    private function runCommand(string $command, array $arguments = []): string
    {
        /** @var KernelInterface $kernel */
        $kernel = $this->get('kernel');

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $commandParams = [];
        $commandParams['command'] = $command;
        if (!empty($arguments)) {
            foreach ($arguments as $key => $value) {
                $commandParams[$key] = $value;
            }
        }
        $input = new ArrayInput($commandParams);

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        return $content;
    }
}
