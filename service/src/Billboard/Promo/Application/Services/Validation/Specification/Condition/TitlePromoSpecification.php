<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Application\Services\Validation\Specification\Condition;

use App\Billboard\Promo\Application\Services\Validation\Specification\NotSpecification;
use App\Billboard\Promo\Application\Services\Validation\Specification\PromoSpecification;
use App\Billboard\Promo\Domain\Entity\Promo;

class TitlePromoSpecification implements PromoSpecification
{
    public function isSatisfiedBy(Promo $promo): bool
    {
        $specification = new NotSpecification(new UpperCaseSpecification(), new ExclamationMarkSpecification());

        return $specification->isSatisfiedBy($promo);
    }
}
