<?php

require __DIR__ . '/vendor/autoload.php';

use Sergii\MankindTest\Mankind;
use Sergii\MankindTest\Person;


$person = new Person();
$mankind = Mankind::getInstance($person);
echo 'percent of men - ' . $mankind->getThePercentageOfMenInMankind() .  '%' . "\n";

try {
    echo 'Person - ';
    print_r($mankind->getPersonById(131));
} catch (Exception $e) {
    echo($e->getMessage()) . "\n";
}


