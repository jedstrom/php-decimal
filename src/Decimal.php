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
        $result = bccomp($this->getValue(), $candidate->getValue(), $this->getPrecision());

        if ($result === 0) {
            return true;
        }

        // check for positive/negative zero equality
        $negatedCandidate = $candidate->multiply(new Decimal('-1'));

        return 0 === bccomp($this->getValue(), $negatedCandidate->getValue(), $this->getPrecision());
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
     * Round using half-away from zero
     *
     * @param $precision
     * @return Decimal
     */
    public function round($precision)
    {
        if ($precision === $this->getPrecision()) {
            return $this;
        }

        if (strpos($this->getValue(), '.') === false) {
            return new Decimal($this->getValue(), $precision);
        }

        $addend = '0.' . str_repeat('0', $precision) . '5';

        if (strpos($this->getValue(), '-') === 0) {
            $addend = '-' . $addend;
        }

        $roundedValue = bcadd(
            $this->getValue(),
            $addend,
            $precision
        );

        return new Decimal($roundedValue, $precision);
    }

    public function add(Decimal $addend)
    {
        if ($this->getPrecision() === $addend->getPrecision()) {
            return new Decimal(
                bcadd($this->getValue(), $addend->getValue(), $this->getPrecision()),
                $this->getPrecision()
            );
        }

        $precision = $this->getPrecision() >= $addend->getPrecision()
            ? $this->getPrecision()
            : $addend->getPrecision();

        $sum = bcadd($this->getValue(), $addend->getValue(), $precision);
        $sum = new Decimal($sum, $precision);

        return $sum->round($this->getPrecision());
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
