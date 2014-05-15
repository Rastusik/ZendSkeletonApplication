<?php

namespace Fieldsets\Entity;

class Profile
{
    /**
     * @var int|null
     */
    private $company;

    /**
     * @var string|null
     */
    private $twitter;

    /**
     * @var string|null
     */
    private $location;

    /**
     * @return int|null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param int|null $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return null|string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param null|string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return null|string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param null|string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
}