<?php

use Zend\Crypt\PublicKey\RsaOptions;

require_once __DIR__ . '/../vendor/autoload.php';

$options = new RsaOptions(['pass_phrase' => 'zf2-advanced']);

$options->generateKeys(['private_key_bits' => 4096]);

file_put_contents(__DIR__ . '/keys/zf2a.pem', $options->getPrivateKey());
file_put_contents(__DIR__ . '/keys/zf2a.pub', $options->getPublicKey());
