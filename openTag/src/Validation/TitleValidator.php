<?php


namespace App\Validation;

class TitleValidator extends AbstractValidator
{
    protected $rules = [
        \App\Validation\Rule\UpperCase::class,
        \App\Validation\Rule\ExclamationMark::class,
    ];
}