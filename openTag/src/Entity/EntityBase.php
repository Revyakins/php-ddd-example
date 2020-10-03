<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

/**
 * @ORM\HasLifecycleCallbacks
 */
class EntityBase
{
    /**
     * @var DateTimeImmutable $created
     *
     * @ORM\Column(name="created_at", type="datetime_immutable")
     */
    protected $createdAt;

    /**
     * @var DateTimeImmutable $updated
     *
     * @ORM\Column(name="updated_at", type="datetime_immutable")
     */
    protected $updatedAt;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @throws \Exception
     */
    public function updatedTimestamps(): void
    {
        $dateTimeNow = new \DateTimeImmutable();

        $this->setUpdatedAt($dateTimeNow);

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }

    public function getCreatedAt() :?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt() :?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}