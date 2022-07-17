<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Domain\Enum;

enum Status: string
{
    case MODERATION = 'M';
    case MODERATION_SUCCESS = 'MS';
    case MODERATION_FAILURE = 'MF';

    public function status(): string
    {
        return match($this)
        {
            self::MODERATION => 'status.moderation',
            self::MODERATION_SUCCESS => 'status.moderation_success',
            self::MODERATION_FAILURE => 'status.moderation_failure',
        };
    }
}
