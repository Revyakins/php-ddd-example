<?php

namespace Validation\Rule;


use function App\Validation\Rule\mb_strtoupper;

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
