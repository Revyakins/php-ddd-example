<?php

declare(strict_types=1);

namespace App\Preview\Infrastruccture\Repository;

use App\Preview\Domain\Entity\Promo;
use App\Preview\Domain\Repository\PromoRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Promo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promo[]    findAll()
 * @method Promo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoRepository extends ServiceEntityRepository implements PromoRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promo::class);
    }

    public function save(Promo $promo): void
    {
        $this->_em->persist($promo);
        $this->_em->flush();
    }
}
