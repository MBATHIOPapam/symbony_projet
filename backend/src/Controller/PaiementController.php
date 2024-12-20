<?php
namespace App\Controller;

use App\Service\PaiementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PaiementController extends AbstractController
{
    private PaiementService $paiementService;

    public function __construct(PaiementService $paiementService)
    {
        $this->paiementService = $paiementService;
    }

    #[Route('/paiement', name: 'create_paiement', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->getContent();
        $paiement = $this->paiementService->createPaiement($data);
        
        return new JsonResponse($paiement, JsonResponse::HTTP_CREATED);
    }

    #[Route('/paiement/{id}', name: 'get_paiement', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $paiement = $this->paiementService->getPaiement($id);
        return new JsonResponse($paiement, JsonResponse::HTTP_OK);
    }
}
