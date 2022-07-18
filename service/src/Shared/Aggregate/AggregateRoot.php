<?php

declare(strict_types=1);

namespace App\Shared\Aggregate;

use App\Shared\Event\DomainEvent;

abstract class AggregateRoot
{
    protected array $domainEvents = [];

    public function recordDomainEvent(DomainEvent $domainEvent): self
    {
        $this->domainEvents[] = $domainEvent;

        return $this;
    }

    public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }
}
