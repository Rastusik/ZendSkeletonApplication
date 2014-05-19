<?php

require_once __DIR__ . '/../vendor/autoload.php';

//$salt = \Zend\Math\Rand::getBytes(32);

//var_dump(base64_encode($salt));

$salt = base64_decode('kvz4wa0Zlofwh1JYs6wRzh0owe51/amVcl5tHafLwaw=');

$password = 'zf2-advanced-password';

var_dump(base64_encode(\Zend\Crypt\Key\Derivation\Pbkdf2::calc('sha256', $password, $salt, 10000, 32)));