<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['paiement_read', 'paiement_write'])]
    private int $id;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank(groups: ['paiement_write'])]
    #[Groups(['paiement_read', 'paiement_write'])]
    private \DateTime $date;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(groups: ['paiement_write'])]
    #[Assert\GreaterThan(value: 0, groups: ['paiement_write'])]
    #[Groups(['paiement_read', 'paiement_write'])]
    private float $montant;

    #[ORM\ManyToOne(targetEntity: Dette::class, inversedBy: 'paiements')]
    #[Groups(['paiement_read', 'paiement_write'])]
    private Dette $dette;
}
