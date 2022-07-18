<?php

namespace App\Billboard\Promo\Application\Services\Validation\Specification\Condition;

use App\Billboard\Promo\Application\Services\Validation\Specification\PromoSpecification;
use App\Billboard\Promo\Domain\Entity\Promo;

class UpperCaseSpecification implements PromoSpecification
{
    public function isSatisfiedBy(Promo $promo): bool
    {
        return mb_strtoupper($promo->getTitle(), 'utf-8') == $promo->getTitle();
    }
}
