<?php

namespace App\Billboard\Promo\Application\Services\Specification\Condition;

use App\Billboard\Promo\Application\Services\Specification\PromoSpecification;
use App\Billboard\Promo\Domain\Entity\Promo;

class ExclamationMarkSpecification implements PromoSpecification
{
    public function isSatisfiedBy(Promo $promo): bool
    {
       return substr_count($promo->getTitle(), '!') > 1;
    }
}