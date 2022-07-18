<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Application\DTO\Request;

class CreatePromo
{
    public function __construct(
        private readonly string $title,
        private readonly string $body,
    ){}

    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }
}
