<?php

declare(strict_types=1);

namespace App\Preview\Domain\ValueObject;

use InvalidArgumentException;

final class PromoTitle
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 30;

    private string $value;

    public function __construct(string $value)
    {
        if (empty($value) || strlen($value) < self::MIN_LENGTH and strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException('Title length is not correct.');
        }

        $this->value = $value;

        return $this;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
