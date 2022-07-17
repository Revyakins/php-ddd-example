<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Application\Services;

use App\Billboard\Promo\Application\DTO\Request\CreatePromo;
use App\Billboard\Promo\Application\DTO\Response\PromoResponse;
use App\Billboard\Promo\Domain\Entity\Promo;
use App\Billboard\Promo\Domain\Repository\PromoRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Contracts\Translation\TranslatorInterface;

class PromoService
{
    public function __construct(
        private readonly PromoRepositoryInterface $promoRepository,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly TranslatorInterface $translator
    ){}

    public function create(CreatePromo $createPromo): PromoResponse
    {
        $promo = Promo::create(
            Uuid::uuid4()->toString(),
            title: $createPromo->title(),
            body: $createPromo->body()
        );

        $this->promoRepository->save($promo);

        foreach ($promo->pullDomainEvents() as $domainEvent) {
            $this->eventDispatcher->dispatch($domainEvent);
        }

        return new PromoResponse(
            id: $promo->getId(),
            active: $promo->getActive(),
            title: $promo->getTitle(),
            body: $promo->getBody(),
            status: $this->translator->trans($promo->getStatus())
        );
    }

    /**
     * @return PromoResponse[]
     */
    public function getPromoResponseList(): iterable
    {
        $promos = $this->promoRepository->findAll();

        $dto = [];
        foreach ($promos as $promo) {
            $dto[] = new PromoResponse(
                id: $promo->getId(),
                active: $promo->getActive(),
                title: $promo->getTitle(),
                body: $promo->getBody(),
                status: $this->translator->trans($promo->getStatus())
            );
        }

        return $dto;
    }
}
