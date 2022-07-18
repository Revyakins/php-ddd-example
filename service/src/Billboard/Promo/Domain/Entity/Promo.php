<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Domain\Entity;

use App\Billboard\Promo\Domain\Enum\Status;
use App\Billboard\Promo\Domain\Event\PromoCreatedEvent;
use App\Billboard\Promo\Domain\Event\StatusUpdatedFailureEvent;
use App\Billboard\Promo\Domain\Event\StatusUpdatedSuccessEvent;
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
        PromoId $promoId,
        PromoTitle $title,
        PromoBody $body
    )
    {
        $this->id = $promoId->value();
        $this->title = $title->value();
        $this->body = $body->value();
        $this->active = false;
        $this->status = Status::MODERATION;

        return $this;
    }

    public static function create(
        string $promoId,
        string $title,
        string $body
    ): self {
        $promo = new self(
            promoId: new PromoId($promoId),
            title: new PromoTitle($title),
            body: new PromoBody($body)
        );

        $promo->recordDomainEvent(new PromoCreatedEvent(new PromoId($promoId)));

        return $promo;
    }

    public static function failure(
        string $promoId,
        string $title,
        string $body
    ): static
    {
        $promo = new self(
            promoId: new PromoId($promoId),
            title: new PromoTitle($title),
            body: new PromoBody($body),
        );
        $promo->setStatus(Status::MODERATION_FAILURE);
        $promo->setActive(false);

        $promo->recordDomainEvent(new StatusUpdatedFailureEvent());

        return $promo;
    }

    public static function success(
        string $promoId,
        string $title,
        string $body
    ): static
    {
        $promo = new self(
            promoId: new PromoId($promoId),
            title: new PromoTitle($title),
            body: new PromoBody($body),
        );
        $promo->setStatus(Status::MODERATION_SUCCESS);
        $promo->setActive(true);

        $promo->recordDomainEvent(new StatusUpdatedSuccessEvent());

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

    private function setStatus(Status $status): static
    {
        $this->status = $status;
        return $this;
    }

    private function setActive(bool $active): static
    {
        $this->active = $active;
        return $this;
    }
}
