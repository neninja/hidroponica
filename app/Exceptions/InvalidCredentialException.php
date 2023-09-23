<?php

namespace App\Exceptions;

class InvalidCredentialException extends AppException
{
    public function __construct()
    {
        parent::__construct('errors.invalid_credential', 401);
    }
}
