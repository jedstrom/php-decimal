<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;

class EqualityTest extends PHPUnit_Framework_TestCase
{
    /**
     * Data provider for equality tests
     *
     * @return array
     */
    public function equalityProvider()
    {
        return [
            // negative int, non-zero precision
            ['-5', 2],

            // negative int, zero precision
            ['-5', 0],

            // negative whole float, non-zero precision
            ['-5.00', 2],

            // negative whole float, zero precision
            ['-5.00', 0],

            // negative float, non-zero precision equaling precision of value
            ['-5.13749', 5],

            // negative float, non-zero precision less than precision of value
            ['-5.13749', 2],

            // negative float, non-zero precision greater than precision of value
            ['-5.13749', 7],

            // zero int, precision greater than zero
            ['0', 5],

            // zero int, zero precision
            ['0', 0],

            // negative zero int, precision greater than zero
            ['-0', 5],

            // negative zero int, zero precision
            ['-0', 0],

            // zero float, zero precision
            ['0.00', 0],

            // zero float, non-zero precision
            ['0.00', 3],

            // negative zero float, zero precision
            ['-0.00', 0],

            // negative zero float, non-zero precision
            ['-0.00', 3],

            //  positive int, non-zero precision
            ['5', 2],

            // positive int, zero precision
            ['5', 0],

            // positive whole float, non-zero precision
            ['5.00', 2],

            // positive whole float, zero precision
            ['5.00', 0],

            // positive float, non-zero precision equaling precision of value
            ['5.13749', 5],

            // positive float, non-zero precision less than precision of value
            ['5.13749', 2],

            // positive float, non-zero precision greater than precision of value
            ['5.13749', 7],
        ];
    }

    /**
     * @test
     * @dataProvider equalityProvider
     *
     * @param string $value
     * @param int $precision
     */
    public function test($value, $precision)
    {
        $decimal = new Decimal($value, $precision);
        $this->assertTrue($decimal->equals(new Decimal($value, $precision)));
    }
}
