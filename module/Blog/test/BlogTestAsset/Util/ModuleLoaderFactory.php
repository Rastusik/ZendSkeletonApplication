<?php

namespace BlogTestAsset\Util;


use Doctrine\Common\DataFixtures\Executor\AbstractExecutor;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\Tools\SchemaTool;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Test\Util\ModuleLoader;

class ModuleLoaderFactory
{
    public function createModuleLoader()
    {
        $moduleLoader = new ModuleLoader([
            'modules' => array(
                'Application',
                'AssetManager',
                'SxBootstrap',
                'DoctrineModule',
                'DoctrineORMModule',
                'Blog',
            ),
            'module_listener_options' => array(
                'module_paths' => [],
                'config_glob_paths' => array(
                    __DIR__ . '/../../testing.local.php',
                ),
            ),
        ]);

        $serviceManager = $moduleLoader->getServiceManager();

        $serviceManager->addDelegator(
            'doctrine.entitymanager.orm_default',
            function (ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback) {
                /* @var $entityManager \Doctrine\ORM\EntityManager */
                $entityManager = $callback();

                $schemaTool = new SchemaTool($entityManager);

                $schemaTool->updateSchema($entityManager->getMetadataFactory()->getAllMetadata());

                return $entityManager;
            }
        );

        $serviceManager->setFactory(
            AbstractExecutor::class,
            function (ServiceLocatorInterface $serviceLocator) {
                /* @var $entityManager \Doctrine\ORM\EntityManager */
                $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');

                return new ORMExecutor($entityManager, new ORMPurger());
            }
        );

        return $moduleLoader;
    }
} 