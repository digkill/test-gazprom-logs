<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\LogManager;
use Application\Service\InfoManager;
use Application\Controller\IndexController;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller.
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $logManager = $container->get(LogManager::class);
        $infoManager = $container->get(InfoManager::class);

        // Instantiate the controller and inject dependencies
        return new IndexController($em, $logManager, $infoManager);
    }
}
