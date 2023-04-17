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

namespace Fabit\SyliusOdooProductPlugin\Downloader;

final class ImageDownloader implements ImageDownloaderInterface
{
    public function saveImage(string $imageContent, string $extension): string
    {
        $productImagesDir = '/tmp';

        if (!is_dir($productImagesDir)) {
            if (!mkdir($concurrentDirectory = $productImagesDir) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }

        $temporaryFilename = \sprintf('%s.%s', uniqid(), $extension);
        $tempPath = \sprintf('%s/%s', $productImagesDir, $temporaryFilename);
        file_put_contents($tempPath, base64_decode($imageContent));

        return $tempPath;
    }
}
