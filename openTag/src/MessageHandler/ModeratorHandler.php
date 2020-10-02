<?php

namespace App\MessageHandler;

use App\Entity\Promo;
use App\Message\SendModerator;
use App\Repository\PromoRepository;
use App\Validation\ModeratorResolverInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Validation\ValidatorException;

class ModeratorHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PromoRepository
     */
    private $promoRepository;

    /**
     * @var ModeratorResolverInterface
     */
    private $moderator;

    /**
     * @var bool
     */
    private $isSuccessModeration = true;

    /**
     * SendModeratorHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param ModeratorResolverInterface $moderator
     */
    public function __construct(EntityManagerInterface $entityManager, ModeratorResolverInterface $moderator)
    {
        $this->entityManager = $entityManager;
        $this->moderator = $moderator;
        $this->promoRepository = $entityManager->getRepository(Promo::class);
    }

    /**
     * @param SendModerator $message
     */
    public function __invoke(SendModerator $message)
    {
        sleep(5);

        /** @var Promo $promo */
        $promo = $this->promoRepository->find($message->getId());

        try {
            $this->moderator->checkTitle($promo->getTitle());
            $this->moderator->checkMainText($promo->getMainText());
        }  catch (ValidatorException $exception) {
            $promo->setStatus(Promo::STATUS_MODERATION_FAILURE);
            $this->entityManager->persist($promo);
            $this->entityManager->flush();

            $this->setIsSuccessModeration(false);
        }

        if ($this->isSuccessModeration()) {
            $promo->setStatus(Promo::STATUS_MODERATION_SUCCESS);
            $promo->setActive(true);
            $this->entityManager->persist($promo);
            $this->entityManager->flush();
        }
    }

    /**
     * @param bool $isSuccessModeration
     */
    public function setIsSuccessModeration(bool $isSuccessModeration): void
    {
        $this->isSuccessModeration = $isSuccessModeration;
    }

    /**
     * @return bool
     */
    public function isSuccessModeration(): bool
    {
        return $this->isSuccessModeration;
    }
}
