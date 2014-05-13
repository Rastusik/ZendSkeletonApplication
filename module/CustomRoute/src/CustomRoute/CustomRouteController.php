<?php
/**
 * Created by PhpStorm.
 * User: ocramius
 * Date: 13/05/14
 * Time: 15:33
 */

namespace CustomRoute;

use Zend\Mvc\Controller\AbstractActionController;

class CustomRouteController extends AbstractActionController
{
    public function indexAction()
    {
        die(var_dump($this->params()->fromRoute()));
    }
}