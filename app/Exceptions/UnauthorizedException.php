<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends AppException
{
    public function __construct()
    {
        parent::__construct("errors.unauthorized", 401);
    }
}
