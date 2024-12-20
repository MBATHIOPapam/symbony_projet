<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
class HistoriqueDette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['historique_read', 'historique_write'])]
    private int $id;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank(groups: ['historique_write'])]
    #[Groups(['historique_read', 'historique_write'])]
    private \DateTime $archivedAt;

    #[ORM\OneToOne(targetEntity: Dette::class)]
    #[Groups(['historique_read', 'historique_write'])]
    private Dette $dette;
}
