<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
class Dette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['dette_read', 'dette_write'])]
    private int $id;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank(groups: ['dette_write'])]
    #[Groups(['dette_read', 'dette_write'])]
    private \DateTime $date;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(groups: ['dette_write'])]
    #[Assert\GreaterThanOrEqual(value: 0, groups: ['dette_write'])]
    #[Groups(['dette_read', 'dette_write'])]
    private float $montant;

    #[ORM\Column(type: 'float')]
    #[Assert\GreaterThanOrEqual(value: 0, groups: ['dette_write'])]
    #[Groups(['dette_read', 'dette_write'])]
    private float $montantVerser = 0.0;

    #[ORM\Column(type: 'float')]
    #[Assert\GreaterThanOrEqual(value: 0, groups: ['dette_write'])]
    #[Groups(['dette_read', 'dette_write'])]
    private float $montantRestant;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'dettes')]
    #[Groups(['dette_read', 'dette_write'])]
    private Client $client;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\Choice(choices: ['En Cours', 'Annulée', 'Validée'], groups: ['dette_write'])]
    #[Groups(['dette_read', 'dette_write'])]
    private string $etat;
}
