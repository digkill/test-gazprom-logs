<?php
namespace Application\Service;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Application\Entity\Log;

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
    public function addNewLog($data)
    {
        $log = new Log();
        $date = date('Y-m-d');
        $log->setDate($date);
        $time = date('H:i:s');
        $log->setTime($time);
        $log->setIp($data['ip']);
        $log->setUrlFrom($data['urlFrom']);
        $log->setUrlTo($data['urlTo']);
        $log->setBrowser($data['browser']);
        $log->setOs($data['os']);
        $this->em->persist($log);
        $this->em->flush();
    }
}