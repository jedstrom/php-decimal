# jedstrom/php-decimal

## A PHP Decimal Type implementation
A value object class that utilizes BCMath functions to perform arbitrary precision arithmetic operations.

## Usage

### Supported Operations
The following operations are currently supported:
 1. Addition
 1. Subtraction
 1. Multiplication
 1. Division

__Source__

    $termOne = new Decimal('2', 2);
    $termTwo = new Decimal('3', 0);
    var_dump($termOne->add($termTwo)->getValue());
    var_dump($termOne->subtract($termTwo)->getValue());
    var_dump($termOne->multiply($termTwo)->getValue());
    var_dump($termOne->divide($termTwo)->getValue());
    // refer to Mixed Precision Calculations section
    var_dump($termTwo->add($termOne)->getValue());
    var_dump($termTwo->subtract($termOne)->getValue());
    var_dump($termTwo->multiply($termOne)->getValue());
    var_dump($termTwo->divide($termOne)->getValue());

__Output__

    string(4) "5.00"
    string(4) "-1.00"
    string(4) "6.00"
    string(4) "0.66"
    string(4) "5"
    string(4) "1"
    string(4) "6"
    string(4) "2"

### Automatic Precision Determination
If the precision is not explicitly set, the precision required to represent the value will be automatically calculated.

__Source__

    $decimal = new Decimal('3.14159');
    var_dump($decimal->getPrecision());
__Output__

    int(5)

### Rounding Methodology
Rounding is performed using the half away from zero method.

__Source__

    $termOne = new Decimal('1');
    $termTwo = new Decimal('1.5');
    $product = $termOne->multiply($termTwo);
    var_dump($product->getValue());
__Output__

    string(1) "2"

__Source__

    $termOne = new Decimal('-1');
    $termTwo = new Decimal('1.5');
    $product = $termOne->multiply($termTwo);
    var_dump($product->getValue());
__Output__

    string(1) "-2"


### Precision Truncation
If a precision is explicitly specified and the value specified requires more precision than specified, the value will be rounded to the specified precision.

__Source__

    $decimal = new Decimal('3.14159', 3);
    var_dump($decimal->getValue());
__Output__

    string(5) "3.142"

### Mixed Precision Calculations
Calculations are performed internally at the maximum precision of either term + 1 and then rounded to the precision of the first term.

So, in the following example:

    19.99 x 0.07125

The internal result is:

    1.424287

And the output is rounded to the precision of the first term (19.99 => 2) to produce:

    1.42

__Source__

    $price   = new Decimal('19.99', 2);
    $taxRate = new Decimal('0.07125', 5');
    $tax     = $price->multiply($taxRate);
    var_dump($tax);
__Output__

    string(4) "1.42"
