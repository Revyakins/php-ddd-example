<?php

namespace App\Billboard\Promo\Application\Event;

class PromoModerationEvent
{
    private string $id;

    public function __construct(string $promoId)
    {
        $this->id = $promoId;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
