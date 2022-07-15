<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Application\Services\Specification;

use App\Billboard\Promo\Domain\Entity\Promo;

interface PromoSpecification
{
    public function isSatisfiedBy(Promo $promo): bool;
}
