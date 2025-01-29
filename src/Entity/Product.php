<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use App\Traits\PropertyEntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    use PropertyEntityTrait;

    #[ORM\Column]
    private ?int $ref = null;

    #[Assert\NotBlank(message: 'Vous devez entrer un prix.')]
    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[Assert\NotBlank(message: 'Vous devez choisir une catégorie.')]
    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[Assert\NotBlank(message: 'Vous devez indiquer le type de la pierre.')]
    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Material $material = null;

    /**
     * @var Collection<int, InvoiceProduct>
     */
    #[ORM\OneToMany(mappedBy: 'product', targetEntity: InvoiceProduct::class, cascade: ['remove'])]
    private Collection $invoiceProducts;

    #[ORM\Column]
    private ?bool $tva = null;

    #[ORM\Column(nullable: true)]
    private ?float $purchasePrice = null;

    public function __construct()
    {
        $this->invoiceProducts = new ArrayCollection();
    }

    public function getLabel(): string
    {
        return sprintf('%d - %s', $this->id, $this->name);
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getRef(): ?int
    {
        return $this->ref;
    }

    public function setRef(int $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): static
    {
        $this->material = $material;

        return $this;
    }

    /**
     * @return Collection<int, InvoiceProduct>
     */
    public function getInvoiceProducts(): Collection
    {
        return $this->invoiceProducts;
    }

    public function addInvoiceProduct(InvoiceProduct $invoiceProduct): static
    {
        if (!$this->invoiceProducts->contains($invoiceProduct)) {
            $this->invoiceProducts->add($invoiceProduct);
            $invoiceProduct->setProduct($this);
        }

        return $this;
    }

    public function removeInvoiceProduct(InvoiceProduct $invoiceProduct): static
    {
        if ($this->invoiceProducts->removeElement($invoiceProduct)) {
            // set the owning side to null (unless already changed)
            if ($invoiceProduct->getProduct() === $this) {
                $invoiceProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function isTva(): ?bool
    {
        return $this->tva;
    }

    public function setTva(bool $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    public function getPurchasePrice(): ?float
    {
        return $this->purchasePrice;
    }

    public function setPurchasePrice(?float $purchasePrice): static
    {
        $this->purchasePrice = $purchasePrice;

        return $this;
    }
}
