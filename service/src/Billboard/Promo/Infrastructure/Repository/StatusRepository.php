<?php

namespace App\Billboard\Promo\Infrastructure\Repository;

use App\Billboard\Promo\Domain\Entity\Status;
use App\Billboard\Promo\Domain\Repository\StatusRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StatusRepository extends ServiceEntityRepository implements StatusRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Status::class);
    }

    public function save(Status $status): void
    {
        $this->_em->persist($status);
        $this->_em->flush();
    }
}
