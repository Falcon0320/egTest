<?php
declare(strict_types=1);

namespace Jacques\JkEgTest;

use Exception;

class Math
{
    public function calcDivisors(int $num): array
    {
        if ($num === 0)
        {
            throw new InvalidNumberException('Incorrect value received: 0');
        }

        $num = abs($num);
        $divisors = [];

        for ($i = 2; $i <= $num/2; $i++)
        {
            $result = $num / $i;
            if (is_int($result))
            {
                if (in_array($result, $divisors))
                {
                    break;
                }

                $divisors[] = $i;

                if ($result === $i)
                {
                    break;
                }
                $divisors[] = $result;
            }
        }

        sort($divisors);
        return $divisors;
    }

    public function calcFactorial(int $num): int
    {
        if ($num < 0 || $num > 12)
        {
            throw new Exception('Incorrect value received: '.$num.' Enter a value between 0 and 12');
        }

        $result = $num;
        for ($i = $num-1; $i > 1; $i--)
        {
            $result *= $i;
        }

        return $result;
    }

    public function calcPrimeNumbers(array $nums): string
    {
        $primes = [];

        foreach ($nums as $num)
        {
            if (empty($this->calcDivisors($num)))
            {
                $primes[] = $num;
            }
        }

        return $this->getXmlString($primes);
    }

    private function getXmlString(array $primes): string
    {
        $xml = '
            <?xml version="1.0" encoding="UTF-8"?>
                <primeNumbers amount='.count($primes).'>
        ';

        if (!empty($primes))
        {
            $xml .= '<result>';
        }

        foreach($primes as $prime)
        {
            $xml .= '
                <number>'.$prime.'</number>
            ';
        }

        if (!empty($primes))
        {
            $xml .= '</result>';
        }

        $xml .= '</primeNumbers>';
        return $xml;
    }
}
