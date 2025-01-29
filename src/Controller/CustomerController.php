<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use App\Repository\TypeCustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/customer')]
class CustomerController extends AbstractController
{
    #[Route('/', name: 'app_customer_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(CustomerRepository $customerRepository): Response
    {
        $customer = $customerRepository->findAll();
        return $this->render('customer/index.html.twig', [
            'customers' => $customer,
        ]);
    }

    #[Route('/new', name: 'app_customer_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customer->setDateValue();
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customer/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_customer_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(
        Customer $customer
    ): Response {
        $typeCustomer = $customer->getType();
        $invoices = $customer->getInvoices();
        return $this->render('customer/show.html.twig', [
            'customer' => $customer,
            'typeCustomer' => $typeCustomer,
            'invoices' => $invoices
        ]);
    }

    #[Route('/{id}/edit', name: 'app_customer_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Customer $customer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customer/edit.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }
}
