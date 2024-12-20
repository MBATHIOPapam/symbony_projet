<?php
namespace App\Service;

use App\Entity\DemandeDeDette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DemandeDeDetteService
{
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public function createDemandeDeDette(string $data): DemandeDeDette
    {
        $demande = $this->serializer->deserialize($data, DemandeDeDette::class, 'json');
        $this->em->persist($demande);
        $this->em->flush();
        
        return $demande;
    }
}
