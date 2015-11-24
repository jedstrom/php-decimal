<?php

namespace Decimal;

use Jedstrom\Decimal;

class MultiplicationTest extends \PHPUnit_Framework_TestCase
{
    public function multiplicationProvider()
    {
        return [
            ['2', 0, '3', 0, '6'],
            ['2', 0, '-1', 0, '-2'],
            ['-2', 0, '-5', 0, '10'],
            ['7.99', 2, '0.07125', 5, '0.57'],
        ];
    }

    /**
     * @dataProvider multiplicationProvider
     * @param string $firstValue
     * @param int $firstPrecision
     * @param string $secondValue
     * @param int $secondPrecision
     * @param string $productValue
     */
    public function testMultiplication($firstValue, $firstPrecision, $secondValue, $secondPrecision, $productValue)
    {
        $termOne = new Decimal($firstValue, $firstPrecision);
        $termTwo = new Decimal($secondValue, $secondPrecision);

        $this->assertEquals($productValue, $termOne->multiply($termTwo)->getValue());
    }
}
