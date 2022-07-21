<?php
declare(strict_types=1);

use Jacques\JkEgTest\Math;

require_once 'vendor/autoload.php';

$math = new Math();
echo $math->calcFactorial(3);
