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
        return 0 === bccomp($this->getValue(), $candidate->getValue(), $this->getPrecision());
    }

    /**
     * Returns true if $candidate is less than current value
     *
     * @param Decimal $candidate
     * @return bool
     */
    public function greaterThan(Decimal $candidate)
    {
        return bccomp($this->getValue(), $candidate->getValue()) > 0;
    }

    /**
     * Returns true if $candidate is greater than the current value
     *
     * @param Decimal $candidate
     * @return bool
     */
    public function lessThan(Decimal $candidate)
    {
        return bccomp($this->getValue(), $candidate->getValue()) < 0;
    }

    /**
     * Convenience method, returns true if $candidate is greater than or equal to current value
     *
     * @param Decimal $candidate
     * @return bool
     */
    public function greaterThanOrEqual(Decimal $candidate)
    {
        return $this->greaterThan($candidate) || $this->equals($candidate);
    }

    /**
     * Convenience method, returns true if $candidate is less than or equal to current value
     *
     * @param Decimal $candidate
     * @return bool
     */
    public function lessThanOrEqual(Decimal $candidate)
    {
        return $this->lessThan($candidate) || $this->equals($candidate);
    }

    /**
     * @param Decimal $multiplier
     * @return Decimal
     */
    public function multiply(Decimal $multiplier)
    {
        return new Decimal(
            bcmul($this->getValue(), $multiplier->getValue(), $this->getPrecision()),
            $this->getPrecision()
        );
    }
}
