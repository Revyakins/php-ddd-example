<?php

namespace App\Billboard\Promo\Domain\Event;

use App\Shared\Event\DomainEvent;
use DateTimeImmutable;
use Symfony\Contracts\EventDispatcher\Event;

class StatusUpdatedSuccessEvent extends Event implements DomainEvent
{
    protected DateTimeImmutable $occurred;

    public function __construct()
    {
        $this->occurred = new DateTimeImmutable();
    }

    public function getOccurred(): DateTimeImmutable
    {
        return $this->occurred;
    }
}
