<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * Récupérer tous les clients avec ou sans compte utilisateur.
     */
    public function findClientsByAccountStatus(bool $hasAccount): array
    {
        $qb = $this->createQueryBuilder('c');
        if ($hasAccount) {
            $qb->andWhere('c.account IS NOT NULL');
        } else {
            $qb->andWhere('c.account IS NULL');
        }
        return $qb->getQuery()->getResult();
    }
}
