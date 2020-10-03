<?php


namespace App\Validation;

interface ModeratorResolverInterface
{
    /**
     * @param string $title
     * @throws ValidatorException
     * @return mixed
     */
    public function checkTitle(string $title);

    /**
     * @param string $mainText
     * @throws ValidatorException
     * @return mixed
     */
    public function checkMainText(string $mainText);
}
