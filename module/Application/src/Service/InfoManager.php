<?php
namespace Application\Service;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Application\Entity\Info;

/**
 * The InfoManager service is responsible for adding new info record
 */
class InfoManager
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager;
     */
    private $em;

    /**
     * InfoManager constructor.
     * @param $em
     */
    public function __construct($em)
    {
        $this->em = $em;
    }

    /**
     * This method adds a new info.
     */
    public function addNewInfo($data)
    {
        $log = new Info();
        $log->setIp($data['ip']);
        $log->setBrowser($data['browser']);
        $log->setOs($data['os']);
        $this->em->persist($log);
        $this->em->flush();
    }
}