<?php
namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ArticleService
{
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public function createArticle(string $data): Article
    {
        $article = $this->serializer->deserialize($data, Article::class, 'json');
        $this->em->persist($article);
        $this->em->flush();
        
        return $article;
    }

    public function getArticle(int $id): Article
    {
        return $this->em->getRepository(Article::class)->find($id);
    }

    public function updateArticle(string $data, int $id): Article
    {
        $article = $this->em->getRepository(Article::class)->find($id);
        $updatedArticle = $this->serializer->deserialize($data, Article::class, 'json');
        $article->setName($updatedArticle->getName());
        $article->setQuantityInStock($updatedArticle->getQuantityInStock());
        $article->setPrice($updatedArticle->getPrice());
        
        $this->em->flush();

        return $article;
    }
}
