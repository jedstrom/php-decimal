<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;

class EqualityTest extends PHPUnit_Framework_TestCase
{
    /**
     * Data provider for same precision equality tests
     *
     * @return array
     */
    public function identityProvider()
    {
        return [
            'negative int, non-zero precision'                                   => ['-5', 2],
            'negative int, zero precision'                                       => ['-5', 0],
            'negative whole float, non-zero precision'                           => ['-5.00', 2],
            'negative whole float, zero precision'                               => ['-5.00', 0],
            'negative float, non-zero precision equaling precision of value'     => ['-5.13749', 5],
            'negative float, non-zero precision less than precision of value'    => ['-5.13749', 2],
            'negative float, non-zero precision greater than precision of value' => ['-5.13749', 7],
            'zero int, precision greater than zero'                              => ['0', 5],
            'zero int, zero precision'                                           => ['0', 0],
            'negative zero int, precision greater than zero'                     => ['-0', 5],
            'negative zero int, zero precision'                                  => ['-0', 0],
            'zero float, zero precision'                                         => ['0.00', 0],
            'zero float, non-zero precision'                                     => ['0.00', 3],
            'negative zero float, zero precision'                                => ['-0.00', 0],
            'negative zero float, non-zero precision'                            => ['-0.00', 3],
            'positive int, non-zero precision'                                   => ['5', 2],
            'positive int, zero precision'                                       => ['5', 0],
            'positive whole float, non-zero precision'                           => ['5.00', 2],
            'positive whole float, zero precision'                               => ['5.00', 0],
            'positive float, non-zero precision equaling precision of value'     => ['5.13749', 5],
            'positive float, non-zero precision less than precision of value'    => ['5.13749', 2],
            'positive float, non-zero precision greater than precision of value' => ['5.13749', 7],
        ];
    }

    /**
     * Data provider for different precision equality tests
     *
     * @return array
     */
    public function edgeCaseProvider()
    {
        return [
            'positive zero int not equal to negative zero int, zero precision'                                                                 => ['0', 0, '-0', 0, true],
            'positive zero int not equal to negative zero float, zero precision'                                                               => ['0', 0, '-0.0', 0, true],
            'positive zero int not equal to negative zero int, non-zero precision'                                                             => ['0', 2, '-0', 2, true],
            'positive zero float not equal to negative zero float, zero precision'                                                             => ['0.00', 0, '-0.00', 0, true],
            'positive zero float not equal to negative zero float, non-zero precision'                                                         => ['0.00', 2, '-0.00', 2, true],
            'positive zero not equal to negative zero int, differing non-zero precisions'                                                      => ['0', 2, '-0', 5, true],
            'positive zero not equal to negative zero float, differing non-zero precisions'                                                    => ['0', 2, '-0.00', 5, true],
            'negative int, differing precisions'                                                                                               => ['-5', 2, '-5', 3, true],
            'negative whole float, differing precisions'                                                                                       => ['-5.00', 2, '-5.000', 3, true],
            'negative float, trailing zeroes on first term'                                                                                    => ['-5.1374900', 7, '-5.13749', 5, true],
            'negative float, trailing zeroes on second term'                                                                                   => ['-5.13749', 5, '-5.1374900', 7, true],
            'negative float, first term and second term match to precision of first term, second term has more precision with non-zero values' => ['-5.13749', 5, '-5.13749024', 7, true],
            'negative float, first term and second term match to precision of first term, first term has more precision with non-zero values'  => ['-5.13749024', 7, '-5.13749', 5, false],
        ];
    }

    /**
     * @dataProvider identityProvider
     *
     * @param string $value
     * @param int $precision
     */
    public function testIdentityEquality($value, $precision)
    {
        $decimal = new Decimal($value, $precision);
        $this->assertTrue($decimal->equals(new Decimal($value, $precision)));
    }

    /**
     * @dataProvider edgeCaseProvider
     *
     * @param string $firstValue
     * @param int $firstPrecision
     * @param string $secondValue
     * @param int $secondPrecision
     * @param bool $expected
     */
    public function testEdgeCases($firstValue, $firstPrecision, $secondValue, $secondPrecision, $expected)
    {
        $firstTerm  = new Decimal($firstValue, $firstPrecision);
        $secondTerm = new Decimal($secondValue, $secondPrecision);

        $this->assertEquals($expected, $firstTerm->equals($secondTerm));
    }
}
