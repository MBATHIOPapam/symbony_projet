<?php
namespace App\Controller;

use App\Service\DetteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DetteController extends AbstractController
{
    private DetteService $detteService;

    public function __construct(DetteService $detteService)
    {
        $this->detteService = $detteService;
    }

    #[Route('/dette', name: 'create_dette', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->getContent();
        $dette = $this->detteService->createDette($data);
        
        return new JsonResponse($dette, JsonResponse::HTTP_CREATED);
    }

    #[Route('/dette/{id}', name: 'get_dette', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $dette = $this->detteService->getDette($id);
        return new JsonResponse($dette, JsonResponse::HTTP_OK);
    }
}
