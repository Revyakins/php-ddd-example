<?php
declare(strict_types=1);

namespace App\Billboard\Promo\Application\Services\MessageHandler;

use App\Billboard\Promo\Application\Event\PromoModerationEvent;
use App\Billboard\Promo\Application\Services\Specification\Event\PromoCreatedSpecification;
use App\Billboard\Promo\Domain\Entity\Promo;
use App\Billboard\Promo\Domain\Enum\Status;
use App\Billboard\Promo\Domain\Repository\PromoRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ModeratorHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly PromoRepositoryInterface $promoRepository,
        private readonly EventDispatcherInterface $eventDispatcher
    ){}

    public function __invoke(PromoModerationEvent $message): void
    {
        /** @var Promo $promo */
        $promo = $this->promoRepository->find($message->getId());

        if (! (new PromoCreatedSpecification())->check($promo)) {
            $promo->updateStatus(Status::MODERATION_FAILURE);
        } else {
            $promo->updateStatus(Status::MODERATION_SUCCESS);
        }

        $this->promoRepository->save($promo);

        foreach ($promo->pullDomainEvents() as $domainEvent) {
            $this->eventDispatcher->dispatch($domainEvent);
        }
    }
}
