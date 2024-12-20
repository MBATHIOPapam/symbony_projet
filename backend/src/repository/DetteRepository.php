<?php

namespace App\Repository;

use App\Entity\Dette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dette[]    findAll()
 * @method Dette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dette::class);
    }

    /**
     * Récupérer les dettes non soldées d'un client.
     */
    public function findUnpaidDebtsByClient(int $clientId): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.client = :clientId')
            ->andWhere('d.montantRestant > 0')
            ->setParameter('clientId', $clientId)
            ->getQuery()
            ->getResult();
    }
}
