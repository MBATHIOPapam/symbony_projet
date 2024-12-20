<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user_read', 'user_write'])]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Assert\NotBlank(groups: ['user_write'])]
    #[Assert\Email(groups: ['user_write'])]
    #[Groups(['user_read', 'user_write'])]
    private string $email;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(groups: ['user_write'])]
    #[Assert\Length(min: 3, max: 50, groups: ['user_write'])]
    #[Groups(['user_read', 'user_write'])]
    private string $login;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(groups: ['user_write'])]
    #[Assert\Length(min: 6, groups: ['user_write'])]
    #[Groups(['user_write'])]
    private string $password;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\Choice(choices: ['Boutiquier', 'Admin', 'Client'], groups: ['user_write'])]
    #[Groups(['user_read', 'user_write'])]
    private string $role;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['user_read', 'user_write'])]
    private bool $isActive = true;
}
