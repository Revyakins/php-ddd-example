<?php


namespace Validation;

class TitleValidator extends AbstractValidator
{
    protected $rules = [
        \Validation\Rule\UpperCase::class,
        \Validation\Rule\ExclamationMark::class,
    ];
}