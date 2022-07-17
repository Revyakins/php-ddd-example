<?php

namespace App\Billboard\Promo\Application\Services\Validation\Specification;

use App\Billboard\Promo\Domain\Entity\Promo;

class NotSpecification implements PromoSpecification
{
    private array $specifications;

    public function __construct(PromoSpecification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(Promo $promo): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($promo)) {
                return false;
            }
        }

        return true;
    }
}
