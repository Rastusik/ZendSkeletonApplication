<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class IndexController extends ActionController
{

    public function __construct(\Zend\Mvc\Controller\PluginBroker $broker)
    {

    }

    public function indexAction()
    {
        if(!$this->locator instanceof \Zend\Di\Di) {
            throw new \BadMethodCallException('No locator of type Zend\Di\Di provided!');
        }
        $dumper = new \Zend\Di\Instance\Dumper($this->locator);
        var_dump($dumper->getInitialInstanceDefinitions());
        var_dump($dumper->getInjectedDefinitions(__CLASS__));


        die();

        return new ViewModel();
    }
}
