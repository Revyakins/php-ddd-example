<?php

namespace App\Validation\Rule;


class UpperCase extends AbstractModeratorRule implements ModeratorRuleInterface
{

    /**
     * @param string $text
     */
    public function checkRule(string $text)
    {
        if (mb_strtoupper($text, 'utf-8') == $text) {
            $this->setIsSuccess(false);
        }
    }
}
