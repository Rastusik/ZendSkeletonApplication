<?php
// module/Application/src/Application/Controller/GreetingController.php

namespace Application\Controller;

use Application\Service\GreetingService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GreetingController extends AbstractActionController
{
    /**
     * @var GreetingService
     */
    protected $greetingService;

    /**
     * @var GreetingService $greetingService
     */
    public function __construct(GreetingService $greetingService)
    {
        $this->greetingService = $greetingService;
    }

    public function helloAction()
    {
        $name = $this->getRequest()->getQuery('name', 'anonymous');

        return new ViewModel(array('greeting' => $this->greetingService->greet($name)));
    }
}