<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\MaterialRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/{categoryId<\d+>}/{materialId<\d+>}', name: 'app_product_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(
        ProductRepository $productRepository,
        int $categoryId,
        int $materialId,
        CategoryRepository $categoryRepository,
        MaterialRepository $materialRepository
    ): Response {
        $category = $categoryRepository->find($categoryId);
        $material = $materialRepository->find($materialId);
        $products = $productRepository->getAllProductByCategoryAndMaterial(
            $categoryId,
            $materialId
        );
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'categoryId' => $categoryId,
            'category' => $category,
            'materialId' => $materialId,
            'material' => $material
        ]);
    }

    #[Route('/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        ProductRepository $productRepository,
        SessionInterface $session,
    ): Response {
        // Stocker le référent actuel dans la session
        $referer = $request->headers->get('referer');
        $referers = $session->get('referers', []);
        array_unshift($referers, $referer);
        if (count($referers) > 3) {
            array_pop($referers);
        }
        $session->set('referers', $referers);

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newRef = $productRepository->getLastRef() + 1;
            $product->setRef($newRef);
            $entityManager->persist($product);
            $entityManager->flush();


            // Rediriger vers la page d'index des produits avec categoryId et materialId
            $categoryId = $product->getCategory()->getId();
            $materialId = $product->getMaterial()->getId();

            return $this->redirectToRoute('app_product_index', [
                'categoryId' => $categoryId,
                'materialId' => $materialId
            ], Response::HTTP_SEE_OTHER);
        }

        // Récupérer le référent de deux pages avant
        $referers = $session->get('referers', []);
        $twoPagesBackReferer = $referers[1] ?? null;
        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
            'referer' => $referer,
            'twoPagesBackReferer' => $twoPagesBackReferer
        ]);
    }

    #[Route('/{id}', name: 'app_product_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(
        Request $request,
        Product $product,
    ): Response {
        // Récupérer le référent direct de la requête
        $referer = $request->headers->get('referer');

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'referer' => $referer
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Product $product,
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository,
        MaterialRepository $materialRepository,
    ): Response {
        $categoryId = intval($request->query->get('categoryId'));
        $materialId = intval($request->query->get('materialId'));
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_show', ['id' => $product->getId()], Response::HTTP_SEE_OTHER);
        }
        $category = $categoryRepository->find($categoryId);
        $material = $materialRepository->find($materialId);

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
            'category' => $category,
            'material' => $material,
            'categoryId' => $categoryId,
            'materialId' => $materialId
        ]);
    }
}
