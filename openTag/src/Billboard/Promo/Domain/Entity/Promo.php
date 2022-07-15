<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Domain\Entity;

use App\Billboard\Promo\Domain\Enum\Status;
use App\Billboard\Promo\Domain\Event\PromoCreatedEvent;
use App\Billboard\Promo\Domain\Event\StatusUpdatedEvent;
use App\Billboard\Promo\Domain\ValueObject\PromoBody;
use App\Billboard\Promo\Domain\ValueObject\PromoTitle;
use App\Shared\Aggregate\AggregateRoot;

class Promo extends AggregateRoot
{
    private string $id;

    private string $title;

    private string $body;

    private Status $status;

    private bool $active;

    private function __construct(
        string $promoId,
        string $title,
        string $body
    )
    {
        $this->id = $promoId;
        $this->title = $title;
        $this->body = $body;
        $this->active = false;
        $this->status = Status::MODERATION;

        return $this;
    }

    public static function create(
        PromoId $promoId,
        PromoTitle $title,
        PromoBody $body
    ): self {
        $promo = new self(
            promoId: $promoId->value(),
            title: $title->value(),
            body: $body->value()
        );

        $promo->recordDomainEvent(new PromoCreatedEvent($promoId));

        return $promo;
    }

    public function updateStatus(Status $status)
    {
       $this->setStatus($status);

       $this->recordDomainEvent(new StatusUpdatedEvent());

        return $promo;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function getStatus(): string
    {
        return $this->status->status();
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    private function setStatus(Status $status)
    {
        $this->status = $status;
    }
}
