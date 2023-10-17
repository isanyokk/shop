<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $filepath = null;

    #[ORM\Column(length: 255)]
    private ?string $webpath = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Product $product = null;

    #[ORM\Column]
    private ?int $filesize = null;

    #[ORM\Column(length: 255)]
    private ?string $extension = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilepath(): ?string
    {
        return $this->filepath;
    }

    public function setFilepath(string $filepath): static
    {
        $this->filepath = $filepath;

        return $this;
    }

    public function getWebpath(): ?string
    {
        return $this->webpath;
    }

    public function setWebpath(string $webpath): static
    {
        $this->webpath = $webpath;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getFilesize(): ?int
    {
        return $this->filesize;
    }

    public function setFilesize(int $filesize): static
    {
        $this->filesize = $filesize;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): static
    {
        $this->extension = $extension;

        return $this;
    }
}
