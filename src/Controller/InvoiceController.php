<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Repository\InvoiceProductRepository;
use App\Repository\InvoiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/invoice')]
class InvoiceController extends AbstractController
{
    #[Route('/', name: 'app_invoice_index', methods: ['GET'])]
    public function index(
        InvoiceRepository $invoiceRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $invoices = $invoiceRepository->findAllOrderByNulDesc();
        $pagination = $paginator->paginate(
            $invoices,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('invoice/index.html.twig', [
            'invoices' => $invoices,
            'pagination' => $pagination,
        ]);
    }

    #[Route('/{id}', name: 'app_invoice_show', methods: ['GET'])]
    public function show(Invoice $invoice, InvoiceProductRepository $invoiceProductRep): Response
    {
        // lister les produits de la facture
        $products = $invoiceProductRep->findBy(['invoice' => $invoice]);
        return $this->render('invoice/show.html.twig', [
            'invoice' => $invoice,
            'products' => $products,
        ]);
    }

    #[Route('/{id}', name: 'app_invoice_delete', methods: ['POST'])]
    public function delete(Request $request, Invoice $invoice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $invoice->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($invoice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_invoice_index', [], Response::HTTP_SEE_OTHER);
    }
}
