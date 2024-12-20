<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['client_read', 'client_write'])]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(groups: ['client_write'])]
    #[Assert\Length(max: 255, groups: ['client_write'])]
    #[Groups(['client_read', 'client_write'])]
    private string $surname;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank(groups: ['client_write'])]
    #[Assert\Regex(pattern: "/^\d{10}$/", message: "Numéro de téléphone invalide.", groups: ['client_write'])]
    #[Groups(['client_read', 'client_write'])]
    private string $telephone;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(groups: ['client_write'])]
    #[Assert\Length(max: 255, groups: ['client_write'])]
    #[Groups(['client_read', 'client_write'])]
    private string $address;

    #[ORM\OneToOne(targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[Groups(['client_read', 'client_write'])]
    private ?User $account = null;

    #[ORM\Column(type: 'float')]
    #[Assert\GreaterThanOrEqual(value: 0, groups: ['client_write'])]
    #[Groups(['client_read'])]
    private float $totalDebt = 0.0;
}
