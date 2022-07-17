<?php

namespace App\Billboard\Promo\Application\Services\Validation\Specification;

use App\Billboard\Promo\Domain\Entity\Promo;

interface RootSpecification
{
    public function check(Promo $promo): bool;

    public function add(PromoSpecification $promoSpecification): void;
}
