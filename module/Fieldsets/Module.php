<?php

namespace Fieldsets;

use Zend\Mvc\Router\Http\Literal;

class Module
{
    public function getConfig()
    {
        return array(
            'controllers' => array(
                'invokables' => array(
                    FieldsetExampleController::class => FieldsetExampleController::class,
                ),
            ),
            'router' => array(
                'routes' => array(
                    'article' => array(
                        'type' => Literal::class,
                        'options' => array(
                            'route' => '/fieldsets',
                            'defaults' => array(
                                'controller' => FieldsetExampleController::class,
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),
            ),
            'view_manager' => array(
                'template_path_stack' => array(
                    __DIR__ . '/view',
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
