<?php

// src/Service/UserService.php
namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createUser(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function getUserById(int $id): User
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if (!$user) {
            throw new NotFoundHttpException('User not found');
        }
        return $user;
    }

    public function getAllUsers(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function deleteUser(int $id): void
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if (!$user) {
            throw new NotFoundHttpException('User not found');
        }
        $this->em->remove($user);
        $this->em->flush();
    }
}

