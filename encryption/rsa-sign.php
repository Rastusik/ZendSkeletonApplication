<?php

use Zend\Crypt\PublicKey\Rsa;
use Zend\Crypt\PublicKey\RsaOptions;

require_once __DIR__ . '/../vendor/autoload.php';

$rsa = new Rsa(new RsaOptions([
    'public_key'  => new Rsa\PublicKey(__DIR__ . '/keys/zf2a.pub'),
    'private_key' => new Rsa\PrivateKey(__DIR__ . '/keys/zf2a.pem'),
    'pass_phrase' => 'zf2-advanced',
    'binary_output' => false,
]));

var_dump($rsa->sign(file_get_contents(__FILE__)));
