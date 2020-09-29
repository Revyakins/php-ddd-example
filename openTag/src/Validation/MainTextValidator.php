<?php


namespace App\Validation;


class MainTextValidator extends AbstractValidator
{
    protected $rules = [
        \App\Validation\Rule\Email::class
    ];
  }