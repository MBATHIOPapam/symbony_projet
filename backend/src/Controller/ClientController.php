<?php
// src/Controller/ClientController.php
namespace App\Controller;

use App\Entity\Client;
use App\Service\ClientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    private ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    #[Route('/client', name: 'create_client', methods: ['POST'])]
    public function createClient(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $client = new Client();
        $client->setSurname($data['surname']);
        $client->setTelephone($data['telephone']);
        $client->setAddress($data['address']);
        // Assurez-vous de définir les autres propriétés nécessaires

        $this->clientService->createClient($client);

        return $this->json(['message' => 'Client created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/client/{id}', name: 'get_client', methods: ['GET'])]
    public function getClient(int $id): Response
    {
        $client = $this->clientService->getClientById($id);

        return $this->json($client, Response::HTTP_OK, [], ['groups' => 'client_read']);
    }

    #[Route('/client/{id}', name: 'update_client', methods: ['PUT'])]
    public function updateClient(int $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $client = $this->clientService->getClientById($id);

        $client->setSurname($data['surname']);
        $client->setTelephone($data['telephone']);
        $client->setAddress($data['address']);
        // Mettez à jour les autres propriétés nécessaires

        $this->clientService->updateClient($client);

        return $this->json(['message' => 'Client updated successfully']);
    }

    #[Route('/client/{id}', name: 'delete_client', methods: ['DELETE'])]
    public function deleteClient(int $id): Response
    {
        $this->clientService->deleteClient($id);

        return $this->json(['message' => 'Client deleted successfully']);
    }
}
