<?php

namespace XmlRpcServer;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Mvc\Router\Http\Literal;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

class MyClient extends Client
{
    public function dispatch(RequestInterface $request, ResponseInterface $response = null)
    {
        $request = new Request();

        $request->setUri('http://google.com/');

        return parent::dispatch($request, $response);
    }
}

class Module
{
    public function getConfig()
    {
        return array(
            'controllers' => array(
                'invokables' => array(
                    ServerController::class  => ServerController::class,
                    RequestController::class => RequestController::class,
                    'google' => MyClient::class,
                ),
            ),
            'router' => array(
                'routes' => array(
                    'xmlrpc-endpoint' => array(
                        'type' => Literal::class,
                        'options' => array(
                            'route' => '/xmlrpc-endpoint',
                            'defaults' => array(
                                'controller' => ServerController::class,
                                'action'     => 'serve',
                            ),
                        ),
                    ),
                    'proxy-to-google' => array(
                        'type' => Literal::class,
                        'options' => array(
                            'route' => '/proxy-to-google',
                            'defaults' => array(
                                'controller' => 'google',
                            ),
                        ),
                    ),
                ),
            ),
            'console' => array(
                'router' => array(
                    'routes' => array(
                        'call-rpc-server' => array(
                            'options' => array(
                                'route'    => 'call_greet',
                                'defaults' => array(
                                    'controller' => RequestController::class,
                                    'action'     => 'call-greet'
                                )
                            )
                        ),
                        'generate-wsdl' => array(
                            'options' => array(
                                'route'    => 'generate_wsdl',
                                'defaults' => array(
                                    'controller' => RequestController::class,
                                    'action'     => 'to-wsdl'
                                )
                            )
                        )
                    )
                )
            )
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
