<?php
namespace App\Service;

use App\Entity\HistoriqueDette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class HistoriqueDetteService
{
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public function createHistoriqueDette(string $data): HistoriqueDette
    {
        $historique = $this->serializer->deserialize($data, HistoriqueDette::class, 'json');
        $this->em->persist($historique);
        $this->em->flush();
        
        return $historique;
    }
}
