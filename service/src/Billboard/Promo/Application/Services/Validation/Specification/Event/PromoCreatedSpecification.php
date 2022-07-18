<?php

namespace App\Billboard\Promo\Application\Services\Validation\Specification\Event;

use App\Billboard\Promo\Application\Services\Validation\Specification\AndPromoSpecification;
use App\Billboard\Promo\Application\Services\Validation\Specification\Condition\MainTextSpecification;
use App\Billboard\Promo\Application\Services\Validation\Specification\Condition\TitlePromoSpecification;
use App\Billboard\Promo\Application\Services\Validation\Specification\PromoSpecification;
use App\Billboard\Promo\Application\Services\Validation\Specification\RootSpecification;
use App\Billboard\Promo\Domain\Entity\Promo;

class PromoCreatedSpecification implements PromoSpecification, RootSpecification
{
    /**
     * @var PromoSpecification[]
     */
    private array $specifications = [];

    public function __construct()
    {
        $this->add(new AndPromoSpecification(new TitlePromoSpecification(), new MainTextSpecification()));
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

    public function check(Promo $promo): bool
    {
        return $this->isSatisfiedBy($promo);
    }

    public function add(PromoSpecification $promoSpecification): void
    {
        $this->specifications[] = $promoSpecification;
    }
}
