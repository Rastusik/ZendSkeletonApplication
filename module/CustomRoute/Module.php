<?php
namespace CustomRoute;

class Module
{
    public function getConfig()
    {
        return array(
            'controllers' => array(
                'invokables' => array(
                    CustomRouteController::class => CustomRouteController::class,
                ),
            ),
            'router' => array(
                'routes' => array(
                    'article' => array(
                        'type' => ArticleRoute::class,
                        'options' => array(
                            'articles' => array(
                                'zend-advanced' => 'advanced zf2 course',
                                'zend-basic'    => 'basic zf2 course',
                            ),
                        ),
                    ),
                ),
            ),
            'route_manager' => array(
                'factories' => array(
                    ArticleRoute::class => ArticleRouteFactory::class,
                ),
            ),
        );

    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
