<?php
namespace App\Service;

use App\Entity\Dette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DetteService
{
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public function createDette(string $data): Dette
    {
        $dette = $this->serializer->deserialize($data, Dette::class, 'json');
        $this->em->persist($dette);
        $this->em->flush();
        
        return $dette;
    }

    public function getDette(int $id): Dette
    {
        return $this->em->getRepository(Dette::class)->find($id);
    }
}
