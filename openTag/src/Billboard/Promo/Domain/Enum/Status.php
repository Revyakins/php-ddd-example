<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Domain\Enum;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Contracts\Translation\TranslatorTrait;

enum Status: string
{
    case MODERATION = 'M';
    case MODERATION_SUCCESS = 'MS';
    case MODERATION_FAILURE = 'MF';

    public function status(): string
    {
        $translator = $this->getTranslator();

        return match($this)
        {
            self::MODERATION => $translator->trans('status.moderation'),
            self::MODERATION_SUCCESS => $translator->trans('status.moderation_success'),
            self::MODERATION_FAILURE => $translator->trans('status.moderation_failure'),
        };
    }

    public function getTranslator(): TranslatorInterface
    {
        return new class() implements TranslatorInterface {
            use TranslatorTrait;
        };
    }
}
