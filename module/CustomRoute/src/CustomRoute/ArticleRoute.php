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
use Zend\Stdlib\RequestInterface;

class ArticleRoute implements RouteInterface
{
    public function __construct(array $articles)
    {
        $this->articles = $articles;
    }

    public function match(RequestInterface $request)
    {
        if (! $request instanceof Request) {
            return null;
        }

        $path = ltrim($request->getUri()->getPath(), '/');

        if (! isset($this->articles[$path])) {
            return null;
        }

        return new RouteMatch([
            'article'    => $this->articles[$path],
            'controller' => CustomRouteController::class,
            'action'     => 'index',
        ]);
    }

    public function getAssembledParams()
    {
        return [];
    }

    public function assemble(array $params = array(), array $options = array())
    {
        throw new \BadMethodCallException('Unsupported');
    }

    public static function factory($options = array())
    {
        throw new \BadMethodCallException('Unsupported');
    }
}