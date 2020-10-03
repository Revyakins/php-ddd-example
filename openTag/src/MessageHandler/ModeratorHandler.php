<?php


namespace App\MessageHandler;

use App\Entity\Promo;
use App\Message\SendModerator;
use App\Repository\PromoRepository;
use App\Services\PromoService;
use App\Validation\ModeratorResolverInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Validation\ValidatorException;

class ModeratorHandler
{
    /**
     * @var PromoService
     */
    private $promoService;

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
     * @param PromoService $promoService
     * @param ModeratorResolverInterface $moderator
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        PromoService $promoService,
        ModeratorResolverInterface $moderator,
        EntityManagerInterface $entityManager
    )
    {
        $this->promoService = $promoService;
        $this->moderator = $moderator;
        $this->promoRepository = $entityManager->getRepository(Promo::class);
    }

    /**
     * @param SendModerator $message
     */
    public function __invoke(SendModerator $message)
    {
        //имитация работы модератора
        sleep(5);

        /** @var Promo $promo */
        $promo = $this->promoRepository->find($message->getId());

        try {
            $this->moderator->checkTitle($promo->getTitle());
            $this->moderator->checkMainText($promo->getMainText());
        }  catch (ValidatorException $exception) {
            $this->promoService->setModerationToFailure($promo);
            $this->moderationIsFailure();
        }

        if ($this->isSuccessModeration()) {
            $this->promoService->setModerationToSuccess($promo);
        }
    }

    private function moderationIsFailure()
    {
        $this->isSuccessModeration = false;
    }

    /**
     * @return bool
     */
    public function isSuccessModeration(): bool
    {
        return $this->isSuccessModeration;
    }
}
