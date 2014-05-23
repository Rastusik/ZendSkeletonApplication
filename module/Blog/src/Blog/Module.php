<?php

namespace Blog;

use Blog\Controller\BlogController;
use Blog\Factory\BlogControllerFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return [
            'controllers' => [
                'factories' => [
                    BlogController::class => BlogControllerFactory::class,
                ],
            ],
            'router' => [
                'routes' => array(
                    'blogposts' => array(
                        'type' => Literal::class,
                        'options' => array(
                            'route'    => '/blog',
                            'defaults' => array(
                                'controller' => BlogController::class,
                                'action'     => 'homepage',
                            ),
                        ),
                    ),
                    'blogpost' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route'    => '/blog/:blogPostId',
                            'defaults' => array(
                                'controller' => BlogController::class,
                                'action'     => 'blogpost',
                            ),
                            'constraints' => array(
                                'blogPostId' => '[0-9]+',
                            ),
                        ),
                    ),
                    'delete-blogpost-comment' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route'    => '/blog/:blogPostId/deleteComment/:commentId',
                            'defaults' => array(
                                'controller' => BlogController::class,
                                'action'     => 'delete-comment',
                            ),
                            'constraints' => array(
                                'blogPostId' => '[0-9]+',
                                'commentId'  => '[0-9]+',
                            ),
                        ),
                    ),
                ),
            ],
            'view_manager' => array(
                'template_path_stack' => array(
                    'Blog' => __DIR__ . '/../../view',
                ),
            ),
            'doctrine' => array(
                'driver' => array(
                    'blog_annotations' => array(
                        'class' => AnnotationDriver::class,
                        'cache' => 'array',
                        'paths' => [
                            __DIR__ . '/../../src/Blog/Entity',
                        ],
                    ),

                    'orm_default' => array(
                        'drivers' => array(
                            'Blog\Entity' => 'blog_annotations'
                        )
                    ),
                ),
            ),
        ];
    }
}