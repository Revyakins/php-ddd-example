<?php

namespace App\Billboard\Promo\Application\Services\Validation\Specification\Condition;

use App\Billboard\Promo\Application\Services\Validation\Specification\PromoSpecification;
use App\Billboard\Promo\Domain\Entity\Promo;

class EmailPromoBodySpecification implements PromoSpecification
{
    private $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';

    public function isSatisfiedBy(Promo $promo): bool
    {
        preg_match_all($this->pattern, $promo->getBody(), $matches);

        return !empty($matches[0]);
    }
}
