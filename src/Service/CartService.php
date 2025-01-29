<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Exception;

// Add this line to import the Exception class

class CartService
{
    private RequestStack $requestStack;

    public function __construct(
        RequestStack $requestStack,
    ) {
        $this->requestStack = $requestStack;
    }



    public function addToCart(int $productId, string $productName, float $price, int $quantity): void
    {
        $cart = $this->requestStack->getSession()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Assurez-vous que l'ID du produit est utilisé comme clé
            $cart[$productId] = [
                'productId' => $productId,
                'quantity' => $quantity,
                'price' => $price, // Exemple de récupération du prix du produit
                'productName' => $productName // Exemple de récupération du nom du produit
            ];
        }

        $this->saveCart($cart);
    }

    public function getCart(): array
    {
        $cart = $this->getSession()->get('cart', []);
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
        $cart = $this->getSession()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->saveCart($cart);
        }
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->getSession()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
        } else {
            // Si le produit n'existe pas dans le panier, vous pouvez gérer cette situation ici
            // Par exemple, vous pouvez lever une exception ou ajouter le produit au panier
            throw new Exception("Product with ID $productId not found in cart");
        }

        $this->saveCart($cart);
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

    private function saveCart(array $cart): void
    {
        $this->getSession()->set('cart', $cart);
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}
