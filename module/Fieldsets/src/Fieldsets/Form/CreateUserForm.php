<?php

namespace Fieldsets\Form;

use Fieldsets\Fieldset\UserFieldset;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Submit;
use Zend\Form\Form;
use Zend\Http\Request;
use Zend\Stdlib\Hydrator\ClassMethods;

class CreateUserForm extends Form
{
    public function __construct()
    {
        parent::__construct('create_user');

        $this->setAttribute('method', Request::METHOD_POST);
        $this->setHydrator(new ClassMethods());

        $this->add([
            'type' => UserFieldset::class,
            'options' => ['use_as_base_fieldset' => true],
        ]);

        $this->add([
            'name' => 'csrf',
            'type' => Csrf::class,
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Send!',
            ],
        ]);
    }
} 