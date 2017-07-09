<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Log;
use Zend\Code\Scanner\ClassScanner;
use Zend\Code\Scanner\FileScanner;
use Zend\View\View;
use RestApi\Controller\ApiController;


class LogController extends ApiController
{

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Log manager.
     * @var Application\Service\LogManager
     */
    private $logManager;

    /**
     * Constructor is used for injecting dependencies into the controller.
     */
    public function __construct($em, $logManager)
    {
        $this->em = $em;
        $this->logManager = $logManager;
    }

    public function getAction()
    {
        $this->httpStatusCode = 200;

        $limit = $this->getRequest()->getQuery('limit', null);
        $start = $this->getRequest()->getQuery('start', null);
        /**
         * @var LogRepository $logsRepository
         */
        $logsRepository = $this->em->getRepository(Log::class);
        $countLogs = $logsRepository->countLogs();

        $logsAll = $logsRepository->findAllLogsNative($limit, $start);
        $content = $logsAll->getArrayResult();

        



        $this->apiResponse['content'] = $content;
        $this->apiResponse['total'] = $countLogs;

        return $this->createResponse();
    }

}
