<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $faceContent = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $backContent = null;

    #[ORM\ManyToOne(inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?File $file = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFaceContent(): ?string
    {
        return $this->faceContent;
    }

    public function setFaceContent(?string $faceContent): static
    {
        $this->faceContent = $faceContent;

        return $this;
    }

    public function getBackContent(): ?string
    {
        return $this->backContent;
    }

    public function setBackContent(?string $backContent): static
    {
        $this->backContent = $backContent;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): static
    {
        $this->file = $file;

        return $this;
    }
}
