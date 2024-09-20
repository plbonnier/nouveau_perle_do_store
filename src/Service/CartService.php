<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }



    public function addToCart(int $productId, string $productName, float $price, int $quantity): void
    {
        $cart = $this->requestStack->getSession()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'productName' => $productName,
                'price' => $price,
                'quantity' => $quantity,
            ];
        }

        $this->getSession()->set('cart', $cart);
    }

    public function getCart(): array
    {
        $cart = $this->getSession()->get('cart');
        $cartData = [];

        if ($cart) {
            foreach ($cart as $productId => $product) {
                $cartData[] = [
                    'productId' => $productId,
                    'productName' => $product['productName'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'total' => $product['price'] * $product['quantity'],
                ];
            }
        }
        return $cartData;
    }

    public function removeFromCart(int $productId): void
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        $this->getSession()->set('cart', $cart);
    }

    // public function updateQuantity(int $productId, int $quantity): void
    // {
    //     $cart = $this->getCart();

    //     if (isset($cart[$productId])) {
    //         $cart[$productId]['quantity'] = $quantity;
    //         $this->session->set('cart', $cart);
    //     }
    // }

    public function clearCart(): void
    {
        $this->getSession()->remove('cart');
    }


    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}
