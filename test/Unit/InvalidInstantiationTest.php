<?php

namespace Decimal;

use Jedstrom\Decimal;
use PHPUnit_Framework_TestCase;
use stdClass;

class InvalidInstantiationTest extends PHPUnit_Framework_TestCase
{
    public function nonStringProvider()
    {
        return [
            [true],
            [false],
            [new stdClass()],
            [1.0],
            [2],
            [-2],
            [[]],
            [new Decimal('0')],
        ];
    }

    public function invalidStringProvider()
    {
        return [
            ['-'],
            ['foo'],
            ['0-0'],
            ['='],
            ['++0'],
            ['-1.000.0'],
            [''],
            ['--0'],
            ['0a'],
        ];
    }

    /**
     * @dataProvider nonStringProvider
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^Expected string/
     * @param mixed $value
     */
    public function testNonStringValue($value)
    {
        new Decimal($value);
    }

    /**
     * @dataProvider invalidStringProvider
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^Invalid format/
     * @param string $value
     */
    public function testInvalidFormat($value)
    {
        new Decimal($value);
    }
}
