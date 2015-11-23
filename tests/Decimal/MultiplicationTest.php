<?php

namespace Decimal;

use Jedstrom\Decimal;

class MultiplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testMultiplication()
    {
        $termOne = new Decimal('2', 0);
        $termTwo = new Decimal('3', 0);
        $product = new Decimal('6', 0);

        $this->assertTrue($termOne->multiply($termTwo)->equals($product));

        $termTwo = new Decimal('-1');
        $product = new Decimal('-2');

        $this->assertTrue($termOne->multiply($termTwo)->equals($product));
    }
}
