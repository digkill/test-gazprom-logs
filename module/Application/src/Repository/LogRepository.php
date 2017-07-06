<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Log;
use Application\Entity\Info;

class LogRepository extends EntityRepository
{
    /**
     * Retrieves all published posts in descending date order.
     * @return Query
     */
    public function findAllLogs($limit = 10, $start = 0)
    {
        $entityManager = $this->getEntityManager();
        $entityManager1 = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $subQueryFirstFromUrl = $entityManager1->createQueryBuilder()
            ->from(Log::class, 'lfu')
            ->addSelect('lfu')
            ->addSelect('max(lfu.date) AS "MAX"')
            ->andWhere('lfu.info = i')
            ->addGroupBy('1')
            ->addOrderBy('2', 'desc')

            ->getDQL();



        $queryBuilder->select('l.date as date, l.time as time, l.urlFrom as urlFrom, l.urlTo as urlTo, l.id as id')
            ->from(Log::class, 'l')
            ->leftJoin('l.info', 'i')
            ->addSelect('i.ip as ip')
            ->addSelect('i.browser as browser')
            ->addSelect('i.os as os')
            ->addSelect( "(".$subQueryFirstFromUrl.") as lastFromUrl" )
            //->setParameter('Log', Log::class)
            ->setMaxResults($limit)
            ->setFirstResult($start);

        //  ->where('p.status = ?1')
        //  ->orderBy('p.dateCreated', 'DESC')


/*
        ->leftJoin('self.meal', 'meal')
    +            ->leftJoin('hotel.city', 'city')
    +            ->leftJoin('city.country', 'country')
        ->addSelect('hotel')
  */
        return $queryBuilder->getQuery();
    }

    public function countLogs()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery("SELECT COUNT(l.id) FROM Application\Entity\Log l");
        return $query->getSingleScalarResult();
    }


}

