<?php
namespace Application\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Info
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Application\Repository\InfoRepository")
 * @ORM\Table(name="info")
 */
class Info
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="ip")
     */
    protected $ip;

    /**
     * @ORM\Column(name="browser")
     */
    protected $browser;

    /**
     * @ORM\Column(name="os")
     */
    protected $os;

    /**
     * @ORM\OneToMany(targetEntity="\Application\Entity\Log", mappedBy="ip")
     * @ORM\JoinColumn(name="id", referencedColumnName="info_id")
     */
    protected $logs;

    /**
     * Log constructor.
     */
    public function __construct()
    {
        $this->logs = new ArrayCollection();
    }

    /**
     * Returns ID of this log.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets ID of this log.
     *
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns IP of this log.
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Sets IP of this log.
     *
     * @param $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Returns Browser of this log.
     *
     * @return string
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Sets Browser of this log.
     *
     * @param $browser
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    }

    /**
     * Returns OS of this log.
     *
     * @return string
     */
    public function getOs()
    {
        return $this->browser;
    }

    /**
     * Sets OS of this log.
     *
     * @param $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * Returns Logs of this log.
     *
     * @return string
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Adds a new Logs to this log.
     * @param $logs
     */
    public function addLog($logs)
    {
        $this->logs[] = $logs;
    }

}