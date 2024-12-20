<?php

// src/Controller/UserController.php
namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/user', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setEmail($data['email']);
        $user->setLogin($data['login']);
        $user->setPassword($data['password']);
        $user->setRole($data['role']);
        // Assurez-vous de définir les autres propriétés nécessaires

        $this->userService->createUser($user);

        return $this->json(['message' => 'User created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/user/{id}', name: 'get_user', methods: ['GET'])]
    public function getUser(int $id): Response
    {
        $user = $this->userService->getUserById($id);

        return $this->json($user, Response::HTTP_OK, [], ['groups' => 'user_read']);
    }

    #[Route('/user/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(int $id): Response
    {
        $this->userService->deleteUser($id);

        return $this->json(['message' => 'User deleted successfully']);
    }
}

