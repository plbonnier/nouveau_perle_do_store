<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\CategoryRepository;
use App\Repository\MaterialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/material')]
class MaterialController extends AbstractController
{
    #[Route('/{categoryId<\d+>}', name: 'app_material_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(
        MaterialRepository $materialRepository,
        int $categoryId,
        CategoryRepository $categoryRepository
    ): Response {
        $category = $categoryRepository->find($categoryId);
        $materials = $materialRepository->getAllMaterialByCategory($categoryId);
        return $this->render('material/index.html.twig', [
            'materials' => $materials,
            'categoryId' => $categoryId,
            'category' => $category
        ]);
    }

    #[Route('/new', name: 'app_material_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
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

        $categoryId = intval($request->query->get('categoryId'));
        $material = new Material();
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($material);
            $entityManager->flush();

            // Récupérer le référent de deux pages avant
            $referers = $session->get('referers', []);
            $twoPagesBackReferer = $referers[1] ?? null;

            if ($twoPagesBackReferer) {
                return $this->redirect($twoPagesBackReferer);
            }

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('material/new.html.twig', [
        'material' => $material,
        'form' => $form,
        'categoryId' => $categoryId,
        'referer' => $referer
        ]);
    }

    #[Route('/{id}/edit', name: 'app_material_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(
        Request $request,
        Material $material,
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository,
        MaterialRepository $materialRepository,
    ): Response {
        $categoryId = intval($request->query->get('categoryId'));

        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'app_material_index',
                ['categoryId' => $categoryId],
                Response::HTTP_SEE_OTHER
            );
        }

        $category = $categoryRepository->find($categoryId);
        $materials = $materialRepository->getAllMaterialByCategory($categoryId);

        return $this->render('material/edit.html.twig', [
            'material' => $material,
            'form' => $form,
            'category' => $category,
            'materials' => $materials,
            'categoryId' => $categoryId
        ]);
    }
}
