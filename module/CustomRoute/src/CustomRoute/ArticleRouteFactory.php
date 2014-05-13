<?php
/**
 * Created by PhpStorm.
 * User: ocramius
 * Date: 13/05/14
 * Time: 15:33
 */

namespace CustomRoute;

use Zend\Http\Request;
use Zend\Mvc\Router\Http\RouteInterface;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\RequestInterface;

class ArticleRouteFactory implements FactoryInterface, MutableCreationOptionsInterface
{
    /** @var array */
    private $articles = array();

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ArticleRoute($this->articles);
    }

    public function setCreationOptions(array $options)
    {
        $this->articles = $options['articles'];
    }
}