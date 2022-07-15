<?php

namespace App\Billboard\Promo\Domain\Entity;

class Status
{
    private ?string $key;

    private ?string $title;

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
