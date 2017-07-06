<?php
namespace Application\Service\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\InfoManager;

/**
 * This is the factory for LogManager. Its purpose is to instantiate the
 * service.
 */
class InfoManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new InfoManager($entityManager);
    }
}
