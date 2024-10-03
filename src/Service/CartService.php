<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

// Add this line to import the Product class

class CartService
{
    private RequestStack $requestStack;
    private LoggerInterface $logger;
    private EntityManagerInterface $entityManager;

    public function __construct(
        RequestStack $requestStack,
        LoggerInterface $logger,
        EntityManagerInterface $entityManager
    ) {
        $this->requestStack = $requestStack;
        $this->logger = $logger;
        $this->entityManager = $entityManager;
    }



    public function addToCart(int $productId, string $productName, float $price, int $quantity): void
    {
        $cart = $this->requestStack->getSession()->get('cart', []);

        // Ajout de logs pour vérifier les valeurs des identifiants des produits
        $this->logger->info("Adding product to cart: ID = $productId,
        Name = $productName, Price = $price, Quantity = $quantity");

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
        $cart = $this->getSession()->get('cart', []);

        // Ajout de logs pour vérifier le contenu du panier avant mise à jour
        $this->logger->info("Cart content before update: " . json_encode($cart));

        if (isset($cart[$productId])) {
            $this->logger->info("Updating quantity for product ID: $productId to $quantity");
            $cart[$productId]['quantity'] = $quantity;

            // Mettre à jour la quantité dans la base de données
            $product = $this->entityManager->getRepository(Product::class)->find($productId);
            if ($product) {
                $product->setQuantity($quantity);
                $this->entityManager->flush();
            } else {
                $this->logger->warning("Product ID: $productId not found in database");
            }
        } else {
            $this->logger->warning("Product ID: $productId not found in cart");
        }

        // Ajout de logs pour vérifier le contenu du panier après mise à jour
        $this->logger->info("Cart content after update: " . json_encode($cart));

        $this->getSession()->set('cart', $cart);
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
