<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Application\Entity\Log;
use Application\Entity\Info;

/**
 * The LogManager service is responsible for adding new log record
 */
class LogManager
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager;
     */
    private $em;

    /**
     * LogManager constructor.
     * @param $em
     */
    public function __construct($em)
    {
        $this->em = $em;
    }

    /**
     * This method adds a new logs.
     */
    public function addNewLog($info, $data)
    {
        $log = new Log();
        $log->setInfo($info);

        $date = date('Y-m-d', $data['date']);
        $log->setDate($date);
        $time = date('H:i:s', $data['time']);
        $log->setTime($time);

        $log->setUrlFrom($data['urlFrom']);
        $log->setUrlTo($data['urlTo']);

        $this->em->persist($log);
        $this->em->flush();
    }
}