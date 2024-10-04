import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['quantity'];

    connect() {
        console.log('Quantity controller connected');
    }

    increment(event) {
        event.preventDefault();
        const input = this.quantityTarget;
        input.value = parseInt(input.value) + 1;
    }

    decrement(event) {
        event.preventDefault();
        const input = this.quantityTarget;
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    updateQuantity(event) {
        event.preventDefault();
        console.log('updateQuantity called');
        const input = this.quantityTarget;
        const productId = input.closest('tr').dataset.productId;
        const quantity = input.value;
        console.log('Product ID:', productId); // Ajout de log pour vérifier la valeur de productId

        if (!productId) {
            console.error('Product ID is undefined');
            return;
        }

        console.log(`Updating product ID: ${productId} with quantity: ${quantity}`);

        fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ quantity: quantity }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour l'interface utilisateur
                    const totalCell = input.closest('tr').querySelector('.total');
                    const priceCell = input.closest('tr').querySelector('.price');
                    if (totalCell && priceCell) {
                        const price = parseFloat(priceCell.textContent.replace(' €', ''));
                        totalCell.textContent = (price * quantity).toFixed(2) + ' €';
                    } else {
                        console.error('Price or total cell not found');
                    }

                    // Mettre à jour le sous-total
                    console.log('Calling updateSubtotal');
                    this.updateSubtotal();
                    console.log('Quantité mise à jour avec succès');

                    // Mettre à jour le total des produits
                    console.log('Total products from server:', data.totalProducts); // Ajout de log pour vérifier la valeur de totalProducts
                    const cartElement = document.querySelector('[data-controller="cart"]');
                    if (cartElement) {
                        const cartController = this.application.getControllerForElementAndIdentifier(cartElement, 'cart');
                        if (cartController) {
                            cartController.updateProductTotal(data.totalProducts);
                        } else {
                            console.error('Cart controller not found');
                        }
                    } else {
                        console.error('Cart element not found');
                    }
                } else {
                    // Gérer les erreurs
                    console.error('Erreur lors de la mise à jour de la quantité: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la mise à jour de la quantité', error);
            });
    }

    updateSubtotal() {
        console.log('updateSubtotal called');
        let subtotal = 0;
        document.querySelectorAll('.cart-body').forEach(row => {
            const quantity = parseInt(row.querySelector('.quantity-value').value);
            const price = parseFloat(row.querySelector('.price').textContent.replace(' €', ''));
            subtotal += quantity * price;
        });
        console.log(`New subtotal: ${subtotal.toFixed(2)} €`);
        document.getElementById('subtotal').textContent = subtotal.toFixed(2) + ' €';

        // Mettre à jour le total affiché
        document.getElementById('cart-total').textContent = subtotal.toFixed(2) + ' €';
        document.getElementById('total-input').value = subtotal.toFixed(2);
    }
}