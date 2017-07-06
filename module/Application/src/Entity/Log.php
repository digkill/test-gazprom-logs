<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Log
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Application\Repository\LogRepository")
 * @ORM\Table(name="log")
 */
class Log
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="date")
     */
    protected $date;

    /**
     * @ORM\Column(name="time")
     */
    protected $time;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Info", inversedBy="logs")
     * @ORM\JoinColumn(name="info_id", referencedColumnName="id")
     */
    protected $info;

    /**
     * @ORM\Column(name="urlfrom")
     */
    protected $urlFrom;

    /**
     * @ORM\Column(name="urlto")
     */
    protected $urlTo;

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
     * Returns Date of this log.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets Date of this log.
     *
     * @param $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Returns Time of this log.
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Sets Time of this log.
     *
     * @param $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
      * Returns associated info.
      * @return \Application\Entity\Info
      */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Sets associated info.
     * @param \Application\Entity\Info $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
        $info->addLog($this);
    }

    /**
     * Returns ID of this log.
     *
     * @return string
     */
    public function getUrlFrom()
    {
        return $this->urlFrom;
    }

    /**
     * Sets ID of this log.
     *
     * @param $urlFrom
     */
    public function setUrlFrom($urlFrom)
    {
        $this->urlFrom = $urlFrom;
    }

    /**
     * Returns UrlTo of this log.
     *
     * @return string
     */
    public function getUrlTo()
    {
        return $this->urlTo;
    }

    /**
     * Sets UrlTo of this log.
     *
     * @param $urlTo
     */
    public function setUrlTo($urlTo)
    {
        $this->urlTo = $urlTo;
    }

}