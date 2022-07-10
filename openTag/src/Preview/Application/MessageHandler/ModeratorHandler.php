<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\Preview\Application\Event\PromoModerationEvent;
use App\Preview\Application\Services\PromoService;

class ModeratorHandler
{
    private PromoService $promoService;

    /**
     * @param PromoService $promoService
     */
    public function __construct(PromoService $promoService)
    {
        $this->promoService = $promoService;
    }

    /**
     * @param PromoModerationEvent $message
     */
    public function __invoke(PromoModerationEvent $message): void
    {
        $this->promoService->checkModerator($message->getId());
    }
}
