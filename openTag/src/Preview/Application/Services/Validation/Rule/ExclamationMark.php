<?php


namespace Validation\Rule;

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