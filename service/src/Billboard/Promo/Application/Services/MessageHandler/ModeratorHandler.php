<?php
declare(strict_types=1);

namespace App\Billboard\Promo\Application\Services\MessageHandler;

use App\Billboard\Promo\Application\Event\PromoModerationEvent;
use App\Billboard\Promo\Application\Services\Validation\Specification\Event\PromoCreatedSpecification;
use App\Billboard\Promo\Domain\Entity\Promo;
use App\Billboard\Promo\Domain\Repository\PromoRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ModeratorHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly PromoRepositoryInterface $promoRepository,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly PromoCreatedSpecification $promoCreatedSpecification
    ){}

    public function __invoke(PromoModerationEvent $message): void
    {
        /** @var Promo $promo */
        $promo = $this->promoRepository->find($message->getId());

        if (! $this->promoCreatedSpecification->check($promo)) {
            $promoUpdate = $this->promoModerationFailure($promo);
        } else {
            $promoUpdate = $this->promoModerationSuccess($promo);
        }

        $this->promoRepository->update($promo, $promoUpdate);

        foreach ($promo->pullDomainEvents() as $domainEvent) {
            $this->eventDispatcher->dispatch($domainEvent);
        }
    }

    private function promoModerationFailure(Promo $promo): Promo
    {
        return Promo::failure(promoId: $promo->getId(), title: $promo->getTitle(), body: $promo->getBody());
    }

    private function promoModerationSuccess(Promo $promo): Promo
    {
        return Promo::success(promoId: $promo->getId(), title: $promo->getTitle(), body: $promo->getBody());
    }
}
