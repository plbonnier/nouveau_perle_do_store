<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numInvoice = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\Column]
    private ?float $discount = null;

    #[Assert\NotBlank(message: 'Vous devez indiquer un moyen de paiement.')]
    #[ORM\Column(length: 50)]
    private ?string $payementType = null;

    #[Assert\NotBlank(message: 'Vous devez indiquer un client.')]
    #[ORM\ManyToOne(inversedBy: 'invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    /**
     * @var Collection<int, InvoiceProduct>
     */
    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: InvoiceProduct::class, cascade: ['remove'])]
    private Collection $invoiceProducts;

    public function __construct()
    {
        $this->invoiceProducts = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->numInvoice;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumInvoice(): ?int
    {
        return $this->numInvoice;
    }

    public function setNumInvoice(int $numInvoice): static
    {
        $this->numInvoice = $numInvoice;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): static
    {
        $this->discount = $discount;

        return $this;
    }

    public function getPayementType(): ?string
    {
        return $this->payementType;
    }

    public function setPayementType(string $payementType): static
    {
        $this->payementType = $payementType;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

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
            $invoiceProduct->setInvoice($this);
        }

        return $this;
    }

    public function removeInvoiceProduct(InvoiceProduct $invoiceProduct): static
    {
        if ($this->invoiceProducts->removeElement($invoiceProduct)) {
            // set the owning side to null (unless already changed)
            if ($invoiceProduct->getInvoice() === $this) {
                $invoiceProduct->setInvoice(null);
            }
        }

        return $this;
    }
}
