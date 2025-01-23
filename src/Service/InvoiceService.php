<?php

namespace App\Service;

use App\Entity\Customer;
use App\Entity\Invoice;
use App\Entity\InvoiceProduct;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use DateTime;
use App\Repository\ProductRepository;

class InvoiceService
{
    private EntityManagerInterface $entityManager;
    private ProductRepository $productRepository;

    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
    }

    public function createInvoicesFromCart(
        int $customerId,
        array $cart,
        string $paymentMethod,
        float $total,
        float $discountPercentage
    ): array {
        $productsWithTva = [];
        $productsWithoutTva = [];

        foreach ($cart as $item) {
            $product = $this->productRepository->find($item['productId']);
            if ($product->isTva()) {
                $productsWithTva[] = ['product' => $product, 'quantity' => $item['quantity']];
            } else {
                $productsWithoutTva[] = ['product' => $product, 'quantity' => $item['quantity']];;
            }
        }

        // Calculer les totaux avant l'application du rabais
        $totalWithTva = $this->calculateTotal($productsWithTva);
        $totalWithTvam = $this->calculateTotal($productsWithoutTva);

        $totalFinalWithTva = $totalWithTva * (1 - $discountPercentage);
        $totalFinalWithTvam = $totalWithTvam * (1 - $discountPercentage);

        $invoices = [];

        // Créer les factures avec les totaux ajustés
        if (!empty($productsWithTva)) {
            $invoiceWithTva = $this->createInvoice(
                $customerId,
                $productsWithTva,
                $paymentMethod,
                $totalFinalWithTva,
                $discountPercentage,
            );
            $invoices[] = $invoiceWithTva;
        }

        if (!empty($productsWithoutTva)) {
            $invoiceWithoutTva = $this->createInvoice(
                $customerId,
                $productsWithoutTva,
                $paymentMethod,
                $totalFinalWithTvam,
                $discountPercentage,
            );
            $invoices[] = $invoiceWithoutTva;
        }

        return $invoices;
    }

    public function createInvoice(
        int $customerId,
        array $cart,
        string $paymentMethod,
        float $total,
        ?float $discount = 0,
    ): Invoice {
        $invoice = new Invoice();
        $invoice->setNumInvoice($this->entityManager->getRepository(Invoice::class)->findLastNumInvoice() + 1);
        $invoice->setDate(new DateTime('now'));

        $customer = $this->entityManager->getRepository(Customer::class)->find($customerId);
        if ($customer) {
            $invoice->setCustomer($customer);
        } else {
            throw new Exception('Customer not found');
        }

        $invoice->setPayementType($paymentMethod);
        $invoice->setDiscount($discount ?? 0); // Utiliser 0 si discount est null

        //formattage du total pour avoir exactement 2 chiffres après la virgule
        $formattedTotal = round($total, 2);
        $invoice->setTotal($formattedTotal);

        foreach ($cart as $item) {
            $product = $item['product'];
            // $quantity = $item['quantity'];


            if ($product) {
                $invoiceProduct = new InvoiceProduct();
                $invoiceProduct->setProduct($product);
                $invoiceProduct->setInvoice($invoice);
                $invoiceProduct->setQuantity($item['quantity']);

                $invoice->addInvoiceProduct($invoiceProduct);
                $this->entityManager->persist($invoiceProduct);
            }
        }

        // Persister l'entité Invoice
        $this->entityManager->persist($invoice);
        $this->entityManager->flush();

        return $invoice;
    }

    private function calculateTotal(array $products): float
    {
        $total = 0;
        foreach ($products as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];
            $total += $product->getPrice() * $quantity; // Suppose que chaque produit a une méthode getPrice()
        }

        return $total;
    }
}
