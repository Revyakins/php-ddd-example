<?php


namespace App\Services;

use App\Entity\Promo;
use App\Repository\PromoRepository;
use Doctrine\ORM\EntityManagerInterface;

class PromoService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PromoRepository
     */
    private $promoRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->promoRepository = $this->entityManager->getRepository(Promo::class);
    }

    public function create(Promo $promo)
    {
        $this->entityManager->persist($promo);
        $this->entityManager->flush();

        return $promo->getId();
    }

    /**
     * @return mixed Promo[]
     */
    public function getAll()
    {
        return $this->promoRepository->findAll();
    }
}