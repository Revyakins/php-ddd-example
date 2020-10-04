<?php


namespace App\Services;

use App\Entity\Promo;
use App\Message\PromoModerationEvent;
use App\Repository\PromoRepository;
use App\Request\DTO\CreatePromoRequest;
use App\Validation\ModeratorResolverInterface;
use App\Validation\ValidatorException;
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
     * @var ModeratorResolverInterface
     */
    private $moderator;

    /**
     * @var bool
     */
    private $isSuccessModeration = true;

    /**
     * PromoService constructor.
     * @param EntityManagerInterface $entityManager
     * @param MessageBusInterface $bus
     * @param ModeratorResolverInterface $moderator
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        MessageBusInterface $bus,
        ModeratorResolverInterface $moderator
    )
    {
        $this->entityManager = $entityManager;
        $this->bus = $bus;
        $this->promoRepository = $this->entityManager->getRepository(Promo::class);
        $this->moderator = $moderator;
    }

    /**
     * @param CreatePromoRequest $promoRequest
     * @return int|null
     */
    public function create(CreatePromoRequest $promoRequest): int
    {
        $promo = new Promo();
        $promo->setTitle($promoRequest->getTitle())
            ->setMainText($promoRequest->getMainText())
            ->setCategory($promoRequest->getCategory());

        $this->entityManager->persist($promo);
        $this->entityManager->flush();

        return $promo->getId();
    }

    /**
     * @param Promo $promo
     */
    public function setModerationToFailure(Promo $promo)
    {
        $promo->setStatus(Promo::STATUS_MODERATION_FAILURE);
        $this->entityManager->persist($promo);
        $this->entityManager->flush();
    }

    /**
     * @param Promo $promo
     */
    public function setModerationToSuccess(Promo $promo)
    {
        $promo->setStatus(Promo::STATUS_MODERATION_SUCCESS);
        $promo->setActive(true);
        $this->entityManager->persist($promo);
        $this->entityManager->flush();
    }

    /**
     * @param int $promoId
     */
    public function sentToModerate(int $promoId): void
    {
        $this->bus->dispatch(new PromoModerationEvent($promoId));
    }

    /**
     * @param int $promoId
     */
    public function checkModerator(int $promoId)
    {
        $promo = $this->promoRepository->find($promoId);

        try {
            $this->moderator->checkTitle($promo->getTitle());
            $this->moderator->checkMainText($promo->getMainText());
        }  catch (ValidatorException $exception) {
            $this->setModerationToFailure($promo);
            $this->moderationIsFailure();
        }

        if ($this->isSuccessModeration()) {
            $this->setModerationToSuccess($promo);
        }
    }

    /**
     * @return mixed Promo[]
     */
    public function getList(): iterable
    {
        return $this->promoRepository->findAll();
    }

    private function moderationIsFailure()
    {
        $this->isSuccessModeration = false;
    }

    /**
     * @return bool
     */
    private function isSuccessModeration(): bool
    {
        return $this->isSuccessModeration;
    }
}
