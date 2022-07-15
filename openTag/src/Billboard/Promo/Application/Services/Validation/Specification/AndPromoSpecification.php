<?php
declare(strict_types=1);

namespace App\Billboard\Promo\Application\Services\Specification;

use App\Shared\Aggregate\AggregateRoot;

class AndPromoSpecification implements PromoSpecification
{
    private array $specifications;

    public function __construct(PromoSpecification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(AggregateRoot $promo): bool
    {
        foreach ($this->specifications as $specification) {
            if (! $specification->isSatisfiedBy($promo)) {
                return false;
            }
        }

        return true;
    }
}
