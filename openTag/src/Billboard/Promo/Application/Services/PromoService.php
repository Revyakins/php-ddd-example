<?php

declare(strict_types=1);

namespace App\Billboard\Promo\Application\Services;

use App\Billboard\Promo\Application\DTO\Request\CreatePromo;
use App\Billboard\Promo\Domain\Entity\Promo;
use App\Billboard\Promo\Domain\Entity\PromoId;
use App\Billboard\Promo\Domain\Repository\PromoRepositoryInterface;
use App\Billboard\Promo\Domain\ValueObject\PromoBody;
use App\Billboard\Promo\Domain\ValueObject\PromoTitle;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Ramsey\Uuid\Uuid;

class PromoService
{
    private PromoRepositoryInterface $promoRepository;

    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        PromoRepositoryInterface $promoRepository,
        EventDispatcherInterface $eventDispatcher,
    )
    {
        $this->promoRepository = $promoRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function create(CreatePromo $createPromo): Promo
    {
        $promo = Promo::create(
            new PromoId(Uuid::uuid4()->toString()),
            title: new PromoTitle($createPromo->title()),
            body: new PromoBody($createPromo->body())
        );

        $this->promoRepository->save($promo);

        foreach ($promo->pullDomainEvents() as $domainEvent) {
            $this->eventDispatcher->dispatch($domainEvent);
        }

        return $promo;
    }

    /**
     * @return mixed Promo[]
     */
    public function getList(): iterable
    {
        return $this->promoRepository->findAll();
    }
}
