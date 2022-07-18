<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Application\Services\Validation\Specification\Condition;

use App\Billboard\Promo\Application\Services\Validation\Specification\NotSpecification;
use App\Billboard\Promo\Application\Services\Validation\Specification\PromoSpecification;
use App\Billboard\Promo\Domain\Entity\Promo;

class MainTextSpecification implements PromoSpecification
{
    public function isSatisfiedBy(Promo $promo): bool
    {
        $specification = new NotSpecification(new EmailPromoBodySpecification());

        return $specification->isSatisfiedBy($promo);
    }
}
