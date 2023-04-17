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

namespace Fabit\SyliusOdooProductPlugin\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Fabit\SyliusOdooProductPlugin\Entity\OdooProductPluginLog;

/**
 * @extends ServiceEntityRepository<OdooProductPluginLog>
 *
 * @method OdooProductPluginLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method OdooProductPluginLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method OdooProductPluginLog[]    findAll()
 * @method OdooProductPluginLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OdooProductPluginLogRepository extends ServiceEntityRepository implements OdooProductPluginLogRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OdooProductPluginLog::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(OdooProductPluginLog $entity): ? OdooProductPluginLog
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }

    /**
     * This function return last updated date for api call by code
     */
    public function getOdooProductPluginLog(string $code): ? OdooProductPluginLog
    {
        $odooProductPluginLog = $this->findOneBy(['code' => $code]);

        return $odooProductPluginLog;
    }

    /**
     * This function save the last write date to current date time and save into DB
     *
     * @param OdooProductPluginLog $entity
     */
    public function updateWriteDate(?OdooProductPluginLog $entity): ? OdooProductPluginLog
    {
        if (null === $entity) {
            $entity = new OdooProductPluginLog();
        }

        $entity->setUpdatedAt(new \DateTime());
        $entity->setLastSyncDate(new \DateTime());

        return $this->save($entity);
    }
}
