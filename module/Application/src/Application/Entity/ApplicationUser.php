<?php

namespace Application\Entity;

use BjyAuthorize\Provider\Role\ProviderInterface;
use ZfcRbac\Identity\IdentityInterface;
use ZfcUser\Entity\User;

class ApplicationUser extends User implements IdentityInterface, ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        // @TODO mapper loads roles from associated table
        return ['user', 'registered', 'admin'];
    }
}