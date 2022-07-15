<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Application\Services\Specification;

use App\Billboard\Promo\Domain\Entity\Promo;

class OrPromoSpecification implements PromoSpecification
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
                return true;
            }
        }

        return false;
    }
}
