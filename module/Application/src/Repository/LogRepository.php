<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Log;

class LogRepository extends EntityRepository
{
    /**
     * Retrieves all published posts in descending date order.
     * @return Query
     */
    public function findAllLogs($limit = 10, $start = 0)
    {
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('l')
            ->from(Log::class, 'l')
        ->setMaxResults($limit)
        ->setFirstResult($start);
        //  ->where('p.status = ?1')
          //  ->orderBy('p.dateCreated', 'DESC')
          //  ->setParameter('1', Post::STATUS_PUBLISHED);

        return $queryBuilder->getQuery();
    }

    public function countLogs() {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery("SELECT COUNT(l.id) FROM Application\Entity\Log l");
        return $query->getSingleScalarResult();
    }


}

