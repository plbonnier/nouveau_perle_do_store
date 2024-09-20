<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartService $cartService): Response
    {
        $cart = $cartService->getTotal();
        // dd($cart);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/cart/add/{productId<\d+>}', name: 'app_cart_add', methods: ['POST'])]
    public function add(int $productId, Request $request, CartService $cartService): Response
    {
        // $productId = $request->request->get('productId');
        $productName = $request->request->get('productName');
        $price = $request->request->get('price');
        $quantity = $request->request->get('quantity');

        $cartService->addToCart($productId, $productName, $price, $quantity);

        // dd($cartService);

        return $this->redirectToRoute('app_category_index');
    }

    // #[Route('/cart/remove/{productId}', name: 'app_cart_remove')]
    // public function remove(int $productId, CartService $cartService): Response
    // {
    //     $cartService->removeFromCart($productId);

    //     return $this->redirectToRoute('app_cart');
    // }

    // #[Route('/cart/update/{productId}', name: 'app_cart_update', methods: ['POST'])]
    // public function update(Request $request, int $productId, CartService $cartService): Response
    // {
    //     $quantity = $request->request->get('quantity');
    //     $cartService->updateQuantity($productId, $quantity);

    //     return $this->redirectToRoute('app_cart');
    // }

    // #[Route('/cart/clear', name: 'app_cart_clear')]
    // public function clear(CartService $cartService): Response
    // {
    //     $cartService->clearCart();

    //     return $this->redirectToRoute('app_cart');
    // }
}
