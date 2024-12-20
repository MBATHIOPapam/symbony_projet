<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
class DemandeDeDette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['demande_read', 'demande_write'])]
    private int $id;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank(groups: ['demande_write'])]
    #[Groups(['demande_read', 'demande_write'])]
    private \DateTime $date;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\Choice(choices: ['En Cours', 'Annulée'], groups: ['demande_write'])]
    #[Groups(['demande_read', 'demande_write'])]
    private string $etat;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'demandesDeDette')]
    #[Groups(['demande_read', 'demande_write'])]
    private Client $client;

    #[ORM\ManyToMany(targetEntity: Article::class)]
    #[Groups(['demande_read', 'demande_write'])]
    private $articles;
}
