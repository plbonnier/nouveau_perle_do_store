<?php

namespace App\Service;

use App\Entity\Customer;
use App\Entity\Invoice;
use App\Entity\InvoiceProduct;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use DateTime;

class InvoiceService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createInvoice(
        int $customerId,
        array $cart,
        string $paymentMethod,
        float $total,
        ?float $discount = 0
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
        $invoice->setTotal($total);

        foreach ($cart as $item) {
            $productId = $item['productId'];
            $quantity = $item['quantity'];

            $product = $this->entityManager->getRepository(Product::class)->find($productId);
            if ($product) {
                $invoiceProduct = new InvoiceProduct();
                $invoiceProduct->setProduct($product);
                $invoiceProduct->setInvoice($invoice);
                $invoiceProduct->setQuantity($quantity);

                $invoice->addInvoiceProduct($invoiceProduct);
                $this->entityManager->persist($invoiceProduct);
            }
        }

        // Persister l'entité Invoice
        $this->entityManager->persist($invoice);
        $this->entityManager->flush();

        return $invoice;
    }
}
