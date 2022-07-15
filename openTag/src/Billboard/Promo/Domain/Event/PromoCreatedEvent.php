<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Domain\Event;

use App\Billboard\Promo\Domain\Entity\PromoId;
use App\Shared\Event\DomainEvent;
use DateTimeImmutable;
use Symfony\Contracts\EventDispatcher\Event;

class PromoCreatedEvent extends Event implements DomainEvent
{
    protected PromoId $promoId;
    protected DateTimeImmutable $occurred;

    public function __construct(PromoId $promoId)
    {
        $this->promoId = $promoId;
        $this->occurred = new DateTimeImmutable();
    }

    public function getPromoId(): PromoId
    {
        return $this->promoId;
    }

    public function getOccurred(): DateTimeImmutable
    {
        return $this->occurred;
    }
}