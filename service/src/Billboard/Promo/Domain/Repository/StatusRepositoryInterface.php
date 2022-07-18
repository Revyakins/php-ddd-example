<?php

namespace App\Billboard\Promo\Domain\Repository;

use App\Billboard\Promo\Domain\Entity\Status;

/**
 * @method Status|null find($id, $lockMode = null, $lockVersion = null)
 * @method Status|null findOneBy(array $criteria, array $orderBy = null)
 * @method Status[]    findAll()
 * @method Status[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface StatusRepositoryInterface
{
    public function save(Status $status): void;
}
