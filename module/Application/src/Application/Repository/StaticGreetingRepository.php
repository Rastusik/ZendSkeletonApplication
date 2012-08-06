<?php
// module/Application/src/Application/Repository/StaticGreetingRepository.php

namespace Application\Repository;

class StaticGreetingRepository
{
    protected $availableGreetings = array('Hi', 'Hello', 'Hey', 'What\'s up');

    /**
     * @return string
     */
    public function getRandomGreeting()
    {
        return $this->availableGreetings[array_rand($this->availableGreetings)];
    }
}