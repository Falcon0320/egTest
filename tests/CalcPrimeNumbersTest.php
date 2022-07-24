<?php

declare(strict_types=1);

use Jacques\JkEgTest\Math;
use PHPUnit\Framework\TestCase;

require_once './vendor/autoload.php';

class CalcPrimeNumbersTest extends TestCase
{
    public function testReturnsValidXml()
    {
        libxml_use_internal_errors(true);

        $nums = [10, 23, 51, 79, 100, 1013, 1015];
        $math = new Math();
        $xml = $math->calcPrimeNumbers($nums);

        $doc = simplexml_load_string($xml);
        $this->assertNotFalse($doc);
        $errors = libxml_get_errors();

        $this->assertEmpty($errors);
    }

    public function testReturnValidFields()
    {
        $nums = [10, 23, 51, 79, 100, 1013, 1015];
        $math = new Math();
        $xml = $math->calcPrimeNumbers($nums);
        $doc = simplexml_load_string($xml);
        $this->assertNotNull($doc['amount']);

        if (isset($doc->result))
        {
            $this->assertNotEmpty($doc->result->number);
        }
    }

    public function testCorrectValuesReturned()
    {
        $nums = [10, 23, 51, 79, 100, 1013, 1015];
        $math = new Math();
        $xml = $math->calcPrimeNumbers($nums);
        $doc = simplexml_load_string($xml);
        $primeNumbers = $doc->result->number;

        foreach ($primeNumbers as $primeNumber)
        {
            $result = $math->calcDivisors((int) $primeNumber->__toString());
            $this->assertEmpty($result);
        }
    }
}