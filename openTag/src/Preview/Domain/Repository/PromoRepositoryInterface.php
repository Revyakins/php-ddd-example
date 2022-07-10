<?php

declare(strict_types=1);

namespace App\Preview\Domain\Repository;

use App\Preview\Domain\Entity\Promo;

interface PromoRepositoryInterface
{
    public function save(Promo $promo): void;
}
