<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\Api\src\Controller\ProductController;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection(),
    new Get(
        uriTemplate: '/products/{id}/jopa',
        controller: ProductController::class,
        name: 'getJopa'
    ),
    new Post(validationContext: ['groups' => ['Default', 'postValidation']]),
    new Patch(validationContext: ['groups' => ['Default', 'patchValidation']]),
], normalizationContext: ['groups' => ['product']], order: ['id' => 'DESC'])]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'type' => 'exact', 'title' => 'partial'])]
#[ApiFilter(RangeFilter::class, properties: ['price'])]
class Product
{
    public const IMAGES_PATH = 'public/uploads/images/product/';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['product'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['product'])]
    #[Assert\NotBlank(groups: ['postValidation'])]
    #[Assert\NotNull]
    private ?string $title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['product'])]
    #[Assert\GreaterThan(value: 0, groups: ['postValidation', 'patchValidation'])]
    #[Assert\NotNull]
    private ?int $price = null;

    #[ORM\Column(nullable: true)]
    #[Assert\GreaterThanOrEqual(value: 0, groups: ['postValidation', 'patchValidation'])]
    #[Assert\LessThanOrEqual(value: 100,groups: ['postValidation', 'patchValidation'])]
    private ?int $discountPercent = null;

    #[ORM\Column(nullable: true)]
    #[Assert\GreaterThanOrEqual(value: 0, groups: ['postValidation', 'patchValidation'])]
    private ?int $discountValue = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['product'])]
    #[Assert\EnableAutoMapping]
    private ?ProductType $type = null;

    #[ORM\Column(nullable: true)]
    private ?array $images = null;

    #[ORM\ManyToMany(targetEntity: Param::class, inversedBy: 'products')]
    private Collection $params;

    public function __construct()
    {
        $this->params = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscountPercent(): ?int
    {
        return $this->discountPercent;
    }

    public function setDiscountPercent(?int $discountPercent): static
    {
        $this->discountPercent = $discountPercent;

        return $this;
    }

    public function getDiscountValue(): ?int
    {
        return $this->discountValue;
    }

    public function setDiscountValue(?int $discountValue): static
    {
        $this->discountValue = $discountValue;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getType(): ?ProductType
    {
        return $this->type;
    }

    public function setType(?ProductType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): static
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return Collection<int, Param>
     */
    public function getParams(): Collection
    {
        return $this->params;
    }

    public function addParam(Param $param): static
    {
        if (!$this->params->contains($param)) {
            $this->params->add($param);
        }

        return $this;
    }

    public function removeParam(Param $param): static
    {
        $this->params->removeElement($param);

        return $this;
    }
}
