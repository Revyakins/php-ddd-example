<?php

namespace App\Controller\API\V1;

use App\Billboard\Promo\Application\DTO\Response\PromoResponse;
use App\Billboard\Promo\Application\DTO\Request\CreatePromo;
use App\Billboard\Promo\Domain\Entity\Promo;
use App\Billboard\Promo\Application\Services\PromoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/promo')]
final class PromoController extends AbstractController
{

    private PromoService $promoService;

    public function __construct(
        PromoService $promoService
    )
    {
        $this->promoService = $promoService;
    }

    #[Route('/getList', methods: ['GET'])]
    public function getList(): JsonResponse
    {
        try {
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
        } catch (\Throwable $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/create', methods: ['POST'])]
    public function create(CreatePromo $createPromo): JsonResponse
    {
        try {
            $promo = $this->promoService->create($createPromo);
        } catch (\Throwable $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->json(
            (new PromoResponse(
                id: $promo->getId(),
                active: false,
                title: $promo->getTitle(),
                body: $promo->getBody(),
                status: $promo->getStatus()
            )),
            Response::HTTP_CREATED
        );
    }
}
