<?php
declare(strict_types=1);

use Jacques\JkEgTest\Math;

require_once 'vendor/autoload.php';


try
{
    for ($i = 1; $i <= 12; $i++)
    {
        $total = $i;
        for ($j = $i-1; $j > 0; $j--)
        {
            $total *= $j;
        }
        echo $i.' factorial = '.$total.PHP_EOL;
    }
}
catch (Exception $e)
{
    echo $e->getMessage();
}

