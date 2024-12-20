<?php
namespace App\Controller;

use App\Service\HistoriqueDetteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueDetteController extends AbstractController
{
    private HistoriqueDetteService $historiqueDetteService;

    public function __construct(HistoriqueDetteService $historiqueDetteService)
    {
        $this->historiqueDetteService = $historiqueDetteService;
    }

    #[Route('/historique-dette', name: 'create_historique_dette', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->getContent();
        $historique = $this->historiqueDetteService->createHistoriqueDette($data);
        
        return new JsonResponse($historique, JsonResponse::HTTP_CREATED);
    }
}
