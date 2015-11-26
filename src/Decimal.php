<?php
/*
 * (c) Jacob Edstrom <jake@edstrommn.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $this->value     = $this->roundValueToPrecision($value, $precision);
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
        if ($precision === $this->getPrecision() || $this->getPrecision() === 0) {
            return $this;
        }

        return new Decimal(
            $this->roundValueToPrecision($this->getValue(), $precision),
            $precision
        );
    }

    private function roundValueToPrecision($value, $precision)
    {
        $addend = '0.' . str_repeat('0', $precision) . '5';

        if (strpos($value, '-') === 0) {
            $addend = '-' . $addend;
        }

        return bcadd(
            $value,
            $addend,
            $precision
        );
    }

    /**
     * @param callable $operation
     * @param Decimal $firstTerm
     * @param Decimal $secondTerm
     * @return Decimal
     */
    private function performCalculation(callable $operation, Decimal $firstTerm, Decimal $secondTerm)
    {
        if ($firstTerm->getPrecision() === $secondTerm->getPrecision()) {
            return new Decimal(
                $operation($firstTerm->getValue(), $secondTerm->getValue(), $firstTerm->getPrecision()),
                $firstTerm->getPrecision()
            );
        }

        $precision = $firstTerm->getPrecision() >= $secondTerm->getPrecision()
            ? $firstTerm->getPrecision()
            : $secondTerm->getPrecision();

        $precision++;

        $result = $operation($firstTerm->getValue(), $secondTerm->getValue(), $precision);
        $result = new Decimal($result, $precision);

        return $result->round($firstTerm->getPrecision());
    }

    /**
     * @param Decimal $addend
     * @return Decimal
     */
    public function add(Decimal $addend)
    {
        return $this->performCalculation('bcadd', $this, $addend);
    }

    /**
     * @param Decimal $subtrahend
     * @return Decimal
     */
    public function subtract(Decimal $subtrahend)
    {
        return $this->performCalculation('bcsub', $this, $subtrahend);
    }

    /**
     * @param Decimal $multiplier
     * @return Decimal
     */
    public function multiply(Decimal $multiplier)
    {
        return $this->performCalculation('bcmul', $this, $multiplier);
    }

    /**
     * @param Decimal $divisor
     * @return Decimal
     * @throws DivisionByZeroException
     */
    public function divide(Decimal $divisor)
    {
        if (bccomp($divisor->getValue(), '0', $divisor->getPrecision()) === 0) {
            throw new DivisionByZeroException();
        }

        return $this->performCalculation('bcdiv', $this, $divisor);
    }
}
