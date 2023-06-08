<?php

require __DIR__ . '/vendor/autoload.php';

use Sergii\MankindTest\Mankind;

$mankind = Mankind::getInstance();
echo 'percent of men - ' . $mankind->getThePercentageOfMenInMankind() .  '%' . "\n";

try {
    echo 'Person - ';
    print_r($mankind->getPersonById(131));
} catch (Exception $e) {
    echo($e->getMessage()) . "\n";
}


