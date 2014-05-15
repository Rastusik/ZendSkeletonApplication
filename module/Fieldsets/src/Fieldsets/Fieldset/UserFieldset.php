<?php

namespace Fieldsets\Fieldset;

use Fieldsets\Entity\User;
use Zend\Form\Element\Email;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;

class UserFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct('user');

        $this->setHydrator(new ClassMethods());
        $this->setObject(new User());

        $this->add([
            'name'    => 'name',
            'options' => [
                'label' => 'Full Name',
            ],
        ]);
        $this->add([
            'name' => 'email',
            'type' => Email::class,
            'options' => [
                'label' => 'Email',
            ],
        ]);
        $this->add(['type' => ProfileFieldset::class]);
    }
}
