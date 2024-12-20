<?php
namespace App\Service;

use App\Entity\Paiement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PaiementService
{
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public function createPaiement(string $data): Paiement
    {
        $paiement = $this->serializer->deserialize($data, Paiement::class, 'json');
        $this->em->persist($paiement);
        $this->em->flush();
        
        return $paiement;
    }

    public function getPaiement(int $id): Paiement
    {
        return $this->em->getRepository(Paiement::class)->find($id);
    }
}
