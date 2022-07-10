<?php

declare(strict_types=1);

namespace App\Preview\Application\Services;

use App\Preview\Application\DTO\Request\CreatePromo;
use App\Preview\Domain\Entity\Promo;
use App\Preview\Domain\Repository\PromoRepositoryInterface;
use App\Preview\Domain\ValueObject\PromoBody;
use App\Preview\Domain\ValueObject\PromoTitle;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PromoService
{
    private PromoRepositoryInterface $promoRepository;

    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        PromoRepositoryInterface $promoRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->promoRepository = $promoRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param CreatePromo $createPromo
     * @return int
     */
    public function create(CreatePromo $createPromo): int
    {
        $promo = Promo::create(
            title: new PromoTitle($createPromo->title()),
            body: new PromoBody($createPromo->body())
        );

        $this->promoRepository->save($promo);

        foreach ($promo->pullDomainEvents() as $domainEvent) {
            $this->eventDispatcher->dispatch($domainEvent);
        }

        return $promo->getId();
    }

    /**
     * @return mixed Promo[]
     */
    public function getList(): iterable
    {
        return $this->promoRepository->findAll();
    }
}
