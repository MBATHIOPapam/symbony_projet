<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Trouver un utilisateur par son email.
     */
    public function findByEmail(string $email): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Trouver tous les utilisateurs par rôle (ex : Admin, Boutiquier, Client).
     */
    public function findByRole(string $role): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.role = :role')
            ->setParameter('role', $role)
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouver tous les utilisateurs actifs.
     */
    public function findActiveUsers(): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.isActive = :isActive')
            ->setParameter('isActive', true)
            ->getQuery()
            ->getResult();
    }

    /**
     * Désactiver un utilisateur (compte).
     */
    public function disableUser(int $userId): void
    {
        $this->createQueryBuilder('u')
            ->update()
            ->set('u.isActive', ':isActive')
            ->where('u.id = :id')
            ->setParameter('isActive', false)
            ->setParameter('id', $userId)
            ->getQuery()
            ->execute();
    }

    /**
     * Activer un utilisateur (compte).
     */
    public function enableUser(int $userId): void
    {
        $this->createQueryBuilder('u')
            ->update()
            ->set('u.isActive', ':isActive')
            ->where('u.id = :id')
            ->setParameter('isActive', true)
            ->setParameter('id', $userId)
            ->getQuery()
            ->execute();
    }
}
