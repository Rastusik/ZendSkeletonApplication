<?php

namespace XmlRpcServer;

use AnnotationBuilder\Entity\BlogPost;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface;
use Zend\XmlRpc\Server;

class ServerController extends AbstractActionController
{
    public function serveAction()
    {
        $exposedService = new GreetingService();
        $server         = new Server();

        $server->setReturnResponse(true);
        $server->setClass($exposedService);

        $response = $server->handle($this->getRequest());

        if (! $response instanceof ResponseInterface) {
            $output = $this->getResponse();

            $output->setContent($response);

            return $output;
        }

        return $response;
    }
}
