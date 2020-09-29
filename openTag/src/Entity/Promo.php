<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="promo")
 * @ORM\Entity(repositoryClass=App\Repository\PromoRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Promo extends EntityBase
{

    public const STATUS_MODERATION = 'На модерации';

    public const STATUS_MODERATION_SUCCESS = 'Успех';

    public const STATUS_MODERATION_FAILURE = 'Не прошло модерацию';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(
     *      min = 3,
     *      max = 30,
     *      allowEmptyString = false
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotNull
     */
    private $mainText;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotNull
     */
    private $category;

    /**
     * @ORM\Column(type="text")
     */
    private $status;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = false;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getMainText(): ?string
    {
        return $this->mainText;
    }

    public function setMainText(string $mainText): self
    {
        $this->mainText = $mainText;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @ORM\PrePersist
     */
    public function setStatusModerator(): void
    {
        $this->status = self::STATUS_MODERATION;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @ORM\PrePersist
     */
    public function setActiveNo()
    {
        $this->active = false;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
