<?php


namespace App\Services;

use App\Entity\Promo;
use App\Message\SendModerator;
use App\Repository\PromoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class PromoService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var MessageBusInterface
     */
    private $bus;

    /**
     * @var PromoRepository
     */
    private $promoRepository;

    /**
     * PromoService constructor.
     * @param EntityManagerInterface $entityManager
     * @param MessageBusInterface $bus
     */
    public function __construct(EntityManagerInterface $entityManager, MessageBusInterface $bus)
    {
        $this->entityManager = $entityManager;
        $this->bus = $bus;
        $this->promoRepository = $this->entityManager->getRepository(Promo::class);
    }

    /**
     * @param Promo $promo
     * @return int|null
     */
    public function create(Promo $promo): int
    {
        $this->entityManager->persist($promo);
        $this->entityManager->flush();

        return $promo->getId();
    }

    /**
     * @param int $promoId
     */
    public function sentToModerate(int $promoId): void
    {
        $this->bus->dispatch(new SendModerator($promoId));
    }

    /**
     * @return mixed Promo[]
     */
    public function getList(): iterable
    {
        return $this->promoRepository->findAll();
    }
}