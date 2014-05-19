<?php

require_once __DIR__ . '/vendor/autoload.php';

interface Result {}
class Success implements Result {}
class Failure implements Result {}

$evm = new Zend\EventManager\EventManager();


class MyController
{
    private $evm;

    public function __construct(Zend\EventManager\EventManagerInterface $evm) {
        $this->evm = $evm;
    }

    public function loginAction()
    {
        // here $this->authService->login();

        $results = $this->evm->trigger('login', null, [], function ($r) {
            return $r instanceof Result;
        });

        $last = $results->last();

        if ($last instanceof Result) {
            return $last;
        }

        return new Success();
    }
}

$callback = function (\Zend\EventManager\EventInterface $event) {
    // $this->flashMessenger->add('LOGIN SUCCESS');
    $event->stopPropagation(true);
};