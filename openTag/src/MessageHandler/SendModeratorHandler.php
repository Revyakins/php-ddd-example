<?php

namespace App\MessageHandler;

use App\Entity\Promo;
use App\Message\SendModerator;
use App\Repository\PromoRepository;
use App\Validation\MainTextValidator;
use App\Validation\TitleValidator;
use Doctrine\ORM\EntityManagerInterface;
use App\Validation\ValidatorException;

class SendModeratorHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PromoRepository
     */
    private $promoRepository;

    private $isSuccessModeration = true;

    /**
     * SendModeratorHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
            $this->titleModeration($promo);
            $this->mainTextModeration($promo);
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
     * @param Promo $promo
     * @throws ValidatorException
     */
    private function titleModeration(Promo $promo)
    {
        $validator = new TitleValidator();
        $validator->check($promo->getTitle());
    }

    /**
     * @param Promo $promo
     * @throws ValidatorException
     */
    private function mainTextModeration(Promo $promo)
    {
        $validator = new MainTextValidator();
        $validator->check($promo->getMainText());
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
