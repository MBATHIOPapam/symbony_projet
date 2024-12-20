<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['article_read', 'article_write'])]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(groups: ['article_write'])]
    #[Assert\Length(max: 255, groups: ['article_write'])]
    #[Groups(['article_read', 'article_write'])]
    private string $name;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(groups: ['article_write'])]
    #[Assert\GreaterThanOrEqual(value: 0, groups: ['article_write'])]
    #[Groups(['article_read', 'article_write'])]
    private int $quantityInStock;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(groups: ['article_write'])]
    #[Assert\GreaterThanOrEqual(value: 0, groups: ['article_write'])]
    #[Groups(['article_read', 'article_write'])]
    private float $price;
}
