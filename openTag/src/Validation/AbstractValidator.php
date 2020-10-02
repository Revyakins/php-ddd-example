<?php


namespace App\Validation;

use App\Validation\Rule\ModeratorRuleInterface;

abstract class AbstractValidator
{
    /**
     * AbstractValidator constructor.
     * @param string $text
     * @throws ValidatorException
     */
    public function __construct(string $text)
    {
        $this->check($text);
    }

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @param string $text
     * @throws ValidatorException
     */
    public function check(string $text)
    {
        /** @var ModeratorRuleInterface[] $rules */
        $rules = $this->getRules();

        foreach ($rules as $rule) {
            /** @var ModeratorRuleInterface $rule */
            $rule = new $rule();
            $rule->checkRule($text);
            if (! $rule->isSuccess()) {
                throw new ValidatorException();
            }
        }
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}