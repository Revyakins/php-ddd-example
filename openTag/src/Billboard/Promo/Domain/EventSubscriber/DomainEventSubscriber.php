<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Domain\EventSubscriber;

use App\Billboard\Promo\Application\Event\PromoModerationEvent;
use App\Billboard\Promo\Domain\Entity\Promo;
use App\Billboard\Promo\Domain\Event\PromoCreatedEvent;
use App\Billboard\Promo\Domain\Repository\PromoRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class DomainEventSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
        private readonly PromoRepositoryInterface $promoRepository
    ){}

    public static function getSubscribedEvents(): array
    {
        return [
            PromoCreatedEvent::class => 'promoCreatedProcess'
        ];
    }

    public function promoCreatedProcess(PromoCreatedEvent $event): void
    {
        /** @var Promo $promo */
        $promo = $this->promoRepository->find($event->getPromoId()->value());

        if (! $promo) {
            throw new \LogicException('Promo not found');
        }
        $this->messageBus->dispatch(new PromoModerationEvent($promo->getId()));
    }
}
