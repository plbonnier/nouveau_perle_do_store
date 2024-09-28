<?php

namespace App\Controller;

use App\Form\DiscountType;
use App\Repository\CustomerRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartService $cartService, CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findAll();
        $cart = $cartService->getCart();
        $total = $cartService->getTotal();
        $totalProducts = $cartService->countTotalProducts();
        // Créer le formulaire de réduction
        $discountForm = $this->createForm(DiscountType::class);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'total' => $total,
            'discountForm' => $discountForm->createView(),
            'customers' => $customers,
            'totalProducts' => $totalProducts
        ]);
    }

    #[Route('/cart/discount', name: 'app_cart_discount', methods: ['POST'])]
    public function applyDiscount(Request $request, CartService $cartService): JsonResponse
    {
        $form = $this->createForm(DiscountType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discount = $form->get('discount')->getData(); // Récupérer la réduction

            // Calculer le nouveau total avec la réduction
            $newTotal = $cartService->applyDiscount($discount);

            // Renvoyer une réponse JSON avec le nouveau total
            return new JsonResponse([
                'newTotal' => number_format($newTotal, 2)  // Formater le total avec 2 décimales
            ]);
        }

        // En cas de problème, retourner une erreur JSON
        return new JsonResponse(['error' => 'Formulaire invalide'], 400);
    }


    #[Route('/cart/add/{productId<\d+>}', name: 'app_cart_add', methods: ['POST'])]
    public function add(int $productId, Request $request, CartService $cartService): Response
    {
        $productName = $request->request->get('productName');
        $price = $request->request->get('price');
        $quantity = $request->request->get('quantity');

        $cartService->addToCart($productId, $productName, $price, $quantity);

        return $this->redirectToRoute('app_category_index');
    }

    #[Route('/cart/remove/{productId<\d+>}', name: 'app_cart_remove')]
    public function removeToCart(int $productId, CartService $cartService): Response
    {
        $cartService->removeFromCart($productId);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/update/{productId}', name: 'app_cart_update', methods: ['POST'])]
    public function update(Request $request, int $productId, CartService $cartService): Response
    {
        $quantity = $request->request->get('quantity');
        $cartService->updateQuantity($productId, $quantity);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/clear', name: 'app_cart_clear')]
    public function clear(CartService $cartService): Response
    {
        $cartService->clearCart();

        return $this->redirectToRoute('app_cart');
    }
}
