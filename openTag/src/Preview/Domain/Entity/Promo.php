<?php

declare(strict_types=1);

namespace App\Preview\Domain\Entity;

use App\Preview\Domain\ValueObject\PromoBody;
use App\Preview\Domain\ValueObject\PromoTitle;
use App\Shared\Aggregate\AggregateRoot;
use Doctrine\ORM\Mapping as ORM;

class Promo extends AggregateRoot
{
    public const STATUS_MODERATION = 'На модерации';

    public const STATUS_MODERATION_SUCCESS = 'Успех';

    public const STATUS_MODERATION_FAILURE = 'Не прошло модерацию';

    private $id;

    private $title;

    private $body;

    private $statusId;

    private $active = false;

    public static function create(
        PromoTitle $title,
        PromoBody $body
    ): self {
        $promo = new self();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    private function setTitle()
    {

    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @ORM\PrePersist
     */
    public function setStatusModerator(): void
    {
        $this->status = self::STATUS_MODERATION;
    }

    /**
     * @ORM\PrePersist
     */
    public function setNoActive()
    {
        $this->active = false;
    }
}
