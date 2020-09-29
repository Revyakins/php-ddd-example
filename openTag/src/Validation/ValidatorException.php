<?php

namespace App\Validation;

use Throwable;

class ValidatorException extends \Exception
{
    public function __construct(string $message = "Ошибка валидации", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}