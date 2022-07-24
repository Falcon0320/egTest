<?php
declare(strict_types=1);

require_once './vendor/autoload.php';

use Jacques\JkEgTest\Math;
use PHPUnit\Framework\TestCase;

final class CalcDivisorsTest extends TestCase
{
    public function testNonIncorrectValuesReturned()
    {
        $num = 100;
        $math = new Math();
        $divisors = $math->calcDivisors($num);
        
        foreach ($divisors as $divisor)
        {
            $result = $num/$divisor;
            $this->assertIsInt($divisor);
        }
    }

    public function testOmmitOneAndSelf()
    {
        $number = 100;
        $math = new Math();
        $divisors = $math->calcDivisors($number);

        $this->assertNotSame(1, $divisors[0], 'One returned in result set.');
        $this->assertNotSame($number, $divisors[count($divisors)-1], 'Number itself ('.$number.') returned in result set.');
    }

    public function testCannotUseZero()
    {
        $this->expectException('Jacques\JkEgTest\InvalidNumberException');
        $math = new Math();
        $math->calcDivisors(0);
    }

    public function testPrimeNumberReturnsEmpty()
    {
        $math = new Math();
        $divisors = $math->calcDivisors(11);
        $this->assertEmpty($divisors);
    }

    public function testNegativesWork()
    {
        $math = new Math();
        $divisorsPos = $math->calcDivisors(100);
        $divisorsNeg = $math->calcDivisors(-100);

        $this->assertEquals($divisorsPos, $divisorsNeg);
    }
}