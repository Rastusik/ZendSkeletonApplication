<?php

namespace XmlRpcServer;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\AutoDiscover;
use Zend\XmlRpc\Client;

class RequestController extends AbstractActionController
{
    public function callGreetAction()
    {
        $client = new Client('http://localhost:8888/xmlrpc-endpoint');

        var_dump($client->call('greet'));
        var_dump($client->getProxy()->greet());
    }

    public function toWsdlAction()
    {
        $server = new AutoDiscover();

        $server->setClass(new GreetingService());
        $server->setUri('http://foo.bar/');
        $server->setServiceName('service-name');

        echo $server->generate()->toXML();
    }
}
