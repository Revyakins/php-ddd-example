<?php


namespace App\Validation\Rule;

use App\Validation\ValidatorException;

class ExclamationMark extends AbstractModeratorRule implements ModeratorRuleInterface
{
    /**
     * @param string $text
     */
    public function checkRule(string $text)
    {
        if (substr_count($text, '!') > 1) {
            $this->setIsSuccess(false);
        }
    }
}