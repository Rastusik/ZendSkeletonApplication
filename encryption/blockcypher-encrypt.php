<?php

use Zend\Crypt\BlockCipher;

require_once __DIR__ . '/../vendor/autoload.php';

$blockCypher = BlockCipher::factory('mcrypt');

$blockCypher->setKey('zf2-advanced password');

$cypher = $blockCypher->encrypt('Hello! this is an encrypted message!');

$blockCypher->setKey('invalid');

var_dump($blockCypher->decrypt($cypher));
