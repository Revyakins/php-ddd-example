<?php
declare(strict_types=1);

namespace App\Preview\Application\DTO\Response;

use JsonSerializable;

class PromoResponse implements JsonSerializable
{
    public function __construct(
        public readonly int $id,
        public readonly bool $active,
        public readonly string $title,
        public readonly string $body,
        public readonly string $status
    ){}

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
