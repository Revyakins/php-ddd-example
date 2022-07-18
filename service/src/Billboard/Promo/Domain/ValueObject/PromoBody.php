<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Domain\ValueObject;

use InvalidArgumentException;

final class PromoBody
{
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Promo body is not correct.');
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