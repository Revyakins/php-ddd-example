<?php


namespace App\Validation\Rule;


interface ModeratorRuleInterface
{
    /**
     * @param string $text
     * @return mixed
     */
    public function checkRule(string $text);

    public function isSuccess();
}