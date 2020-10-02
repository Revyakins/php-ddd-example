<?php


namespace App\Validation;

class Moderator implements ModeratorResolverInterface
{
    /**
     * @param string $title
     * @throws ValidatorException
     */
    public function checkTitle(string $title)
    {
        new TitleValidator($title);
    }

    /**
     * @param string $mainText
     * @throws ValidatorException
     */
    public function checkMainText(string $mainText)
    {
        new MainTextValidator($mainText);
    }
}