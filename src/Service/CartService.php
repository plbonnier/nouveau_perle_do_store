<?php

namespace App\Service;

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

    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            $this->getSession()->set('cart', $cart);
        }
    }

    public function clearCart(): void
    {
        $this->getSession()->remove('cart');
    }

    public function getTotal(): float
    {
        $total = 0;
        $cart = $this->getCart();

        foreach ($cart as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        return $total;
    }

    public function applyDiscount(float $discount): float
    {
        $total = $this->getTotal();
        $discountedTotal = $total * (1 - $discount);
        return $discountedTotal;
    }

    public function countTotalProducts(): int
    {
        $cart = $this->getCart();
        $count = 0;

        foreach ($cart as $product) {
            $count += $product['quantity'];
        }

        return $count;
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}
