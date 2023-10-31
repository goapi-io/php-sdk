<?php
require './vendor/autoload.php';

$collection = new \GOAPI\IO\Collection([
   'dam','da','df', 
]);

echo $collection[0];