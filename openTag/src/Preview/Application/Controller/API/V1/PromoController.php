<?php

namespace App\Controller\API\V1;

use App\Preview\Application\DTO\Response\PromoResponse;
use App\Preview\Application\DTO\Request\CreatePromo;
use App\Preview\Domain\Entity\Promo;
use App\Preview\Application\Services\PromoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

#[Route('/api/v1/promo')]
final class PromoController extends AbstractController
{
    private ?Request $request;

    private PromoService $promoService;

    public function __construct(
        RequestStack $requestStack,
        PromoService $promoService
    )
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->promoService = $promoService;
    }

    #[Route('/getList', methods: ['GET'])]
    public function getList(): JsonResponse
    {
        /** @var Promo[] $promos */
        $promos = $this->promoService->getList();

        $dto = [];
        foreach ($promos as $promo) {
            $dto[] = (
                new PromoResponse(
                    id: $promo->getId(),
                    active: $promo->getActive(),
                    title: $promo->getTitle(),
                    body: $promo->getBody(),
                    status: $promo->getStatus()
                )
            );
        }

        return $this->json($dto, Response::HTTP_OK);
    }

    #[Route('/create', methods: ['POST'])]
    public function create(CreatePromo $createPromo): JsonResponse
    {
        try {
            $id = $this->promoService->create($createPromo);
        } catch (\Throwable $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->json(
            (new PromoResponse(
                id: $id,
                active: false,
                title: $this->request->get('title'),
                body: $this->request->get('body'),
                status: Promo::STATUS_MODERATION
            )),
            Response::HTTP_CREATED
        );
    }
}
