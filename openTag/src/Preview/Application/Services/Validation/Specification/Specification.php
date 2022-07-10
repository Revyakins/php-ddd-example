<?php

declare(strict_types=1);

namespace Validation\Specification;

use App\Entity\Promo;

interface Specification
{
    /**
     * @param Promo $promo
     * @return bool
     */
    public function isSatisfiedBy(Promo $promo): bool;
}
