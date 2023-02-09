<?php

namespace App\Exceptions;

use Exception;

class InsufficientQuantityProductException extends Exception
{
    protected $message = 'На складе недостаточно товара.';
}
