<?php


namespace App\MessageHandler;

use App\Message\PromoModerationEvent;
use App\Services\PromoService;

class ModeratorHandler
{
    /**
     * @var PromoService
     */
    private $promoService;

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
    public function __invoke(PromoModerationEvent $message)
    {
        $this->promoService->checkModerator($message->getId());
    }
}
