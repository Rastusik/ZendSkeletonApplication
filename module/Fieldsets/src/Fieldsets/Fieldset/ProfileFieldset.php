<?php

namespace Fieldsets\Fieldset;

use Fieldsets\Entity\Profile;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;

class ProfileFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct('profile');

        $this->setHydrator(new ClassMethods());
        $this->setObject(new Profile());

        $this->add([
            'name'    => 'company',
            'options' => [
                'label' => 'Company Name',
            ],
        ]);
        $this->add([
            'name' => 'twitter',
            'options' => [
                'label' => 'Twitter Username (without @)',
            ],
        ]);
        $this->add([
            'name' => 'location',
            'options' => [
                'label' => 'Full Address',
            ],
        ]);
    }
} 