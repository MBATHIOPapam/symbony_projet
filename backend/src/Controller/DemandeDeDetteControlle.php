<?php
namespace App\Controller;

use App\Service\DemandeDeDetteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DemandeDeDetteController extends AbstractController
{
    private DemandeDeDetteService $demandeDeDetteService;

    public function __construct(DemandeDeDetteService $demandeDeDetteService)
    {
        $this->demandeDeDetteService = $demandeDeDetteService;
    }

    #[Route('/demande-dette', name: 'create_demande_dette', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->getContent();
        $demande = $this->demandeDeDetteService->createDemandeDeDette($data);
        
        return new JsonResponse($demande, JsonResponse::HTTP_CREATED);
    }
}
