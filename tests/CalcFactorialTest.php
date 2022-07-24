<?php

declare(strict_types=1);

use Jacques\JkEgTest\Math;
use PHPUnit\Framework\TestCase;

require_once './vendor/autoload.php';

final class CalcFactorialTest extends TestCase
{
    public function testCannotRangeOutsideZeroAndTwelve()
    {
        $this->expectException('Jacques\JkEgTest\InvalidNumberException');
        $math = new Math();
        $math->calcFactorial(-1);
        $math->calcFactorial(13);
    }

    public function testCanRangeBetweenZeroAndTwelve()
    {
        $math = new Math();
        for ($i = 0; $i <= 12; $i++)
        {
            $result = $math->calcFactorial($i);
            $this->assertIsInt($result);
        }
    }

    /**
     * @dataProvider provideNumbers
     */
    public function testIsCalculationCorrect(int $num, int $expected)
    {
        $math = new Math();
        $result = $math->calcFactorial($num);
        $this->assertEquals($expected, $result);
    }

    public function provideNumbers()
    {
        return [
            [1, 1],
            [2, 2],
            [3, 6],
            [4, 24],
            [5, 120],
            [6, 720],
            [7, 5040],
            [8, 40320],
            [9, 362880],
            [10, 3628800],
            [11, 39916800],
            [12, 479001600]
        ];
    }
}
