<?php

namespace AnnotationBuilder;

use Zend\Mvc\Router\Http\Literal;

class Module
{
    public function getConfig()
    {
        return array(
            'controllers' => array(
                'invokables' => array(
                    AnnotationBuilderController::class => AnnotationBuilderController::class,
                ),
            ),
            'router' => array(
                'routes' => array(
                    'article' => array(
                        'type' => Literal::class,
                        'options' => array(
                            'route' => '/annotation-builder',
                            'defaults' => array(
                                'controller' => AnnotationBuilderController::class,
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
