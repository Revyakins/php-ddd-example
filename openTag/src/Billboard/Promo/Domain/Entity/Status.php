<?php

namespace App\Billboard\Promo\Domain\Entity;

class Status
{
    private ?int $id;

    private ?string $key;

    private ?string $title;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
