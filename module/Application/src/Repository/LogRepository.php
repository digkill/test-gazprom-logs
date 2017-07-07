<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Log;
use Application\Entity\Info;
use Doctrine\ORM\Query\ResultSetMapping;

class LogRepository extends EntityRepository
{
    /**
     * Retrieves all published posts in descending date order.
     * P.S. В подзапросах, невозможно установить limit на выборку, придется сделать запрос Native Sql
     * @return Query
     */
    public function findAllLogs($limit = 10, $start = 0)
    {
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();


        $queryBuilder
            ->select('l.date as date, l.time as time, l.urlFrom as urlFrom, l.urlTo as urlTo, l.id as id')
            ->from(Log::class, 'l')
            ->leftJoin('l.info', 'i')
            ->leftJoin(Log::class, 'll')
            ->addSelect('i.ip as ip')
            ->addSelect('i.browser as browser')
            ->addSelect('i.os as os')
            ->setMaxResults($limit)
            ->setFirstResult($start);
        return $queryBuilder->getQuery();
    }

    public function findAllLogsNative($limit = 10, $start = 0)
    {
        $entityManager = $this->getEntityManager();

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Log::class, 'l');
        $rsm->addFieldResult('l', 'id', 'id');
        $rsm->addFieldResult('l', 'date', 'date');
        $rsm->addFieldResult('l', 'time', 'time');
        $rsm->addFieldResult('l', 'urlfrom', 'urlFrom');
        $rsm->addFieldResult('l', 'urlto', 'urlTo');
        $rsm->addJoinedEntityResult(Info::class, 'i',  'l', 'info');
        $rsm->addFieldResult('i', 'info_id', 'id');
        $rsm->addFieldResult('i', 'os', 'os');
        $rsm->addFieldResult('i', 'ip', 'ip');
        $rsm->addFieldResult('i', 'browser', 'browser');

        $sql = '
              SELECT l.id, l.date, l.time, l.urlfrom, l.urlto,
                     i.id as info_id, i.os as os,  i.ip, i.browser
                FROM log l
                  LEFT JOIN info i ON (l.info_id = i.id)
                  LIMIT :limit OFFSET :start
                  ;';

        $query = $entityManager->createNativeQuery($sql, $rsm);

        $query->setParameter('start', $start);
        $query->setParameter('limit', $limit);

        return $query;
    }


    public function countLogs()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery("SELECT COUNT(l.id) FROM Application\Entity\Log l");
        return $query->getSingleScalarResult();
    }


}

