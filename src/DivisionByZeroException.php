<?php

namespace Jedstrom;

use RuntimeException;

class DivisionByZeroException extends RuntimeException
{
    protected $message = 'Division by zero encountered';
}
