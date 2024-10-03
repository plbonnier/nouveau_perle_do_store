<?php

namespace App\Service;

use App\Entity\Invoice;
use App\Entity\Product;
use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use Exception;

class InvoiceService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createInvoice(
        array $cart,
        string $paymentMethod,
        ?float $discount,
        int $customerId,
        float $total
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
            $product = $this->entityManager->getRepository(Product::class)->find($item['productId']);
            if ($product) {
                $invoice->addProduct($product);
            }
        }
        // Vérifier que la réduction est bien assignée à l'entité

        // Persister l'entité Invoice
        $this->entityManager->persist($invoice);
        $this->entityManager->flush();

        return $invoice;
    }
}
