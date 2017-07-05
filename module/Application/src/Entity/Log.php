<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Shadow
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
     * @ORM\Column(name="ip")
     */
    protected $ip;

    /**
     * @ORM\Column(name="urlfrom")
     */
    protected $urlFrom;

    /**
     * @ORM\Column(name="urlto")
     */
    protected $urlTo;

    /**
     * @ORM\Column(name="browser")
     */
    protected $browser;

    /**
     * @ORM\Column(name="os")
     */
    protected $os;

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

}