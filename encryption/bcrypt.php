<?php

use Zend\Crypt\Password\Bcrypt;

require_once __DIR__ . '/../vendor/autoload.php';

$bcrypt = new Bcrypt();

$bcrypt->setCost(10);

$hash = $bcrypt->create('zf2-advanced');

var_dump($bcrypt->verify('wrong-advanced', $hash));
