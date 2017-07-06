<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Info;

class IndexController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Post manager.
     * @var Application\Service\LogManager
     */
    private $logManager;

    /**
     * Post manager.
     * @var Application\Service\InfoManager
     */
    private $infoManager;

    /**
     * Path of public
     * @var string
     */
    private $publicPath;

    /**
     * Constructor is used for injecting dependencies into the controller.
     */
    public function __construct($em, $logManager, $infoManager)
    {
        $this->em = $em;
        $this->logManager = $logManager;
        $this->infoManager = $infoManager;
        $this->publicPath = $_SERVER['DOCUMENT_ROOT'];
    }

    public function parseLogAction()
    {
        $logPathFirst = $this->publicPath . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'log1.txt';
        $logPathSecond = $this->publicPath . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'log2.txt';

        $logContentFirst = file($logPathFirst, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $logContentSecond = file($logPathSecond, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


        /*
                $data = [];

                foreach ($logContentSecond as $line => $currentLine) {
                    list($data[$line]['ip'], $data[$line]['browser'], $data[$line]['os'] ) = explode('|', $currentLine);
                }

                foreach ($data as $currentLine) {
                    $this->infoManager->addNewInfo($currentLine);
                }

        */
        /*
        $data = [];

        foreach ($logContentFirst as $line => $currentLine) {
            list($data[$line]['date'], $data[$line]['time'], $data[$line]['ip'], $data[$line]['urlFrom'], $data[$line]['urlTo']) = explode('|', $currentLine);
        }

        foreach ($data as $currentLine) {
            $info = $this->em->getRepository(Info::class)->findOneBy(array('ip' => $currentLine['ip']));


            if ($info == null) {
                continue;
            }

            $this->logManager->addNewLog($info, $currentLine);
        }
        */

        $templateVars = [];
        return new ViewModel($templateVars);
    }

    public function indexAction()
    {
        return new ViewModel();
    }

}
