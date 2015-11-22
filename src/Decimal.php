<?php

namespace Jedstrom;

/**
 * Class Decimal
 * @package Jedstrom
 */
class Decimal
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var int
     */
    private $precision;

    public function __construct($value, $precision = 0)
    {
        $this->value     = $value;
        $this->precision = $precision;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * @param Decimal $candidate
     * @return bool
     */
    public function equals(Decimal $candidate)
    {
        return $this->getValue() === $candidate->getValue();
    }
}
