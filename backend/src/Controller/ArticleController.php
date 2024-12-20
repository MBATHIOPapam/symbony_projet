<?php
namespace App\Controller;

use App\Entity\Article;
use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ArticleController extends AbstractController
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    #[Route('/article', name: 'create_article', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getContent();
        $article = $this->articleService->createArticle($data);
        
        return new JsonResponse($serializer->serialize($article, 'json'), JsonResponse::HTTP_CREATED, [], true);
    }

    #[Route('/article/{id}', name: 'get_article', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $article = $this->articleService->getArticle($id);
        return new JsonResponse($article, JsonResponse::HTTP_OK);
    }

    #[Route('/article/{id}', name: 'update_article', methods: ['PUT'])]
    public function update(Request $request, int $id, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getContent();
        $article = $this->articleService->updateArticle($data, $id);
        
        return new JsonResponse($serializer->serialize($article, 'json'), JsonResponse::HTTP_OK, [], true);
    }
}
