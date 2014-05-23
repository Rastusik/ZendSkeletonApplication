<?php

namespace Blog\Factory;

use Blog\Controller\BlogController;
use Blog\Entity\BlogPost;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BlogControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $serviceLocator \Zend\ServiceManager\AbstractPluginManager */
        $parentLocator = $serviceLocator->getServiceLocator();
        /* @var $objectManager \Doctrine\Common\Persistence\ObjectManager */
        $objectManager = $parentLocator->get('doctrine.entitymanager.orm_default');
        $repository    = $objectManager->getRepository(BlogPost::class);

        return new BlogController($objectManager, $repository);
    }
}