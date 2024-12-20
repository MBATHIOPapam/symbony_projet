// src/Service/ClientService.php
namespace App\Service;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createClient(Client $client): void
    {
        $this->em->persist($client);
        $this->em->flush();
    }

    public function updateClient(Client $client): void
    {
        $this->em->flush();
    }

    public function deleteClient(int $id): void
    {
        $client = $this->em->getRepository(Client::class)->find($id);
        if (!$client) {
            throw new NotFoundHttpException('Client not found');
        }
        $this->em->remove($client);
        $this->em->flush();
    }

    public function getClientById(int $id): Client
    {
        $client = $this->em->getRepository(Client::class)->find($id);
        if (!$client) {
            throw new NotFoundHttpException('Client not found');
        }
        return $client;
    }

    public function getAllClients(): array
    {
        return $this->em->getRepository(Client::class)->findAll();
    }
}
