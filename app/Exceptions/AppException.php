<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
    public function __construct(public readonly string $errorCode = '', int $code = 0, ?Exception $previous = null)
    {
        parent::__construct(trans($errorCode), $code, $previous);
    }
}
