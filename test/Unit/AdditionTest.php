<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;

class AdditionTest extends PHPUnit_Framework_TestCase
{
    public function additionDataProvider()
    {
        return [
            // single precision
            'single precision, whole floats, positive + positive' => ['5.00', 2, '1.00', 2, '6.00'],
            'single precision, whole floats, positive + negative' => ['5.00', 2, '-1.00', 2, '4.00'],
            'single precision, whole floats, negative + positive' => ['-1.00', 2, '2.00', 2, '1.00'],
            'single precision, whole floats, negative + negative' => ['-1.00', 2, '-2.00', 2, '-3.00'],

            // mixed precision
            'mixed precision, whole floats, positive + positive' => ['5.00', 4, '1.00', 2, '6.0000'],
            'mixed precision, whole floats, positive + negative' => ['5.00', 6, '-1', 0, '4.000000'],
            'mixed precision, whole floats, negative + positive' => ['-1.00', 3, '2.00', 6, '1.000'],
            'mixed precision, whole floats, negative + negative' => ['-1.00', 8, '-2.00', 3, '-3.00000000'],
            'mixed precision, floats, positive + positive'       => ['1.0001', 4, '2.00', 2, '3.0001'],

            ['5.00', 2, '5.005', 3, '10.01'],
            ['5.005', 3, '5.00', 2, '10.005'],
        ];
    }

    /**
     * @dataProvider additionDataProvider
     * @param string $firstValue
     * @param int $firstPrecision
     * @param string $secondValue
     * @param int $secondPrecision
     * @param string $expectedValue
     */
    public function testAddition($firstValue, $firstPrecision, $secondValue, $secondPrecision, $expectedValue)
    {
        $termOne = new Decimal($firstValue, $firstPrecision);
        $termTwo = new Decimal($secondValue, $secondPrecision);

        $this->assertSame($expectedValue, $termOne->add($termTwo)->getValue());
    }
}
