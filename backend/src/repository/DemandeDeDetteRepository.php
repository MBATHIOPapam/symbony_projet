<?php

namespace App\Repository;

use App\Entity\DemandeDeDette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeDeDette|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeDeDette|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeDeDette[]    findAll()
 * @method DemandeDeDette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeDeDetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeDeDette::class);
    }

    /**
     * Récupérer les demandes de dette par état.
     */
    public function findByStatus(string $etat): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.etat = :etat')
            ->setParameter('etat', $etat)
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupérer les demandes d'un client spécifique.
     */
    public function findByClient(int $clientId): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.client = :clientId')
            ->setParameter('clientId', $clientId)
            ->getQuery()
            ->getResult();
    }
}
