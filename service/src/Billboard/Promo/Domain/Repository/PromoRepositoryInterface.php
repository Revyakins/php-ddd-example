<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Domain\Repository;

use App\Billboard\Promo\Domain\Entity\Promo;

interface PromoRepositoryInterface
{
    public function save(Promo $promo): void;
    public function find($id, $lockMode = null, $lockVersion = null);
    public function update(Promo $promo, Promo $promoUpdate): void;
}
