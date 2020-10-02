<?php


namespace App\Validation;

interface ModeratorResolverInterface
{
    public function checkTitle(string $title);

    public function checkMainText(string $mainText);
}
