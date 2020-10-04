<?php


namespace App\MessageHandler;

use App\Entity\Promo;
use App\Message\PromoModerationEvent;
use App\Services\PromoService;
use Doctrine\ORM\EntityManagerInterface;

class ModeratorHandler
{
    /**
     * @var PromoService
     */
    private $promoService;

    /**
     * @param PromoService $promoService
     * @param EntityManagerInterface $entityManager
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
