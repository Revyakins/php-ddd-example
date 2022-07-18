<?php

namespace App\Billboard\Promo\Application\Controller\API\V1;

use App\Billboard\Promo\Application\DTO\Request\CreatePromo;
use App\Billboard\Promo\Application\Services\PromoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/promo')]
final class PromoController extends AbstractController
{
    private PromoService $promoService;

    public function __construct(PromoService $promoService)
    {
        $this->promoService = $promoService;
    }

    #[Route('/getList', methods: ['GET'])]
    public function getList(): JsonResponse
    {
        try {
            return $this->json($this->promoService->getPromoResponseList(), Response::HTTP_OK);
        } catch (\Throwable $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/create', methods: ['POST'])]
    public function create(CreatePromo $createPromo): JsonResponse
    {
        try {
            $promoResponse = $this->promoService->create($createPromo);
        } catch (\Throwable $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->json(
            $promoResponse,
            Response::HTTP_CREATED
        );
    }
}
