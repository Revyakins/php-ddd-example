<?php


namespace Validation\Rule;

class Email extends AbstractModeratorRule implements ModeratorRuleInterface
{
    private $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';

    /**
     * @param string $text
     */
    public function checkRule(string $text)
    {
        preg_match_all($this->getPattern(), $text, $matches);

       if (! empty($matches[0])) {
           $this->setIsSuccess(false);
       }
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }
}