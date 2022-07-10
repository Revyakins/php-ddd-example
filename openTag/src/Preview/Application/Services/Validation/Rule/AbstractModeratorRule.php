<?php


namespace Validation\Rule;


abstract class AbstractModeratorRule implements ModeratorRuleInterface
{
    protected $isSuccess = true;

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @param bool $isSuccess
     */
    public function setIsSuccess(bool $isSuccess): void
    {
        $this->isSuccess = $isSuccess;
    }
}