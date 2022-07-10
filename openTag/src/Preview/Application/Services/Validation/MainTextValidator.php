<?php


namespace Validation;

class MainTextValidator extends AbstractValidator
{
    protected $rules = [
        \Validation\Rule\Email::class,
    ];
}
