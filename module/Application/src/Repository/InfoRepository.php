<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Info;

class InfoRepository extends EntityRepository
{

    public function findAllInfoByIp($ip = null)
    {
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('i')
            ->from(Info::class, 'i')
            ->where('i.ip = :ip')
            ->setParameter('ip', $ip);

        return $queryBuilder->getQuery()->getResult();
    }
}

