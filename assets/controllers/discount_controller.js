import { Controller } from '@hotwired/stimulus';
import axios from 'axios';

export default class extends Controller {
    static targets = ['discount'];

    updateDiscount(event) {
        const selectedOption = event.target.options[event.target.selectedIndex];
        const discount = selectedOption.getAttribute('data-discount');
        this.discountTarget.textContent = discount > 0 ? `${discount * 100}% de réduction` : 'pas de réduction';
    }

    applyDiscount(event) {
        event.preventDefault();  // Empêche la soumission classique du formulaire
    
        const formElement = event.target.closest('form');  // Cible le formulaire actuel
        const form = new FormData(formElement);  // Récupère les données du formulaire
        const url = formElement.action;  // URL où envoyer la requête
    
        // Mettre à jour le champ caché avec la valeur de la réduction
        const discountElement = formElement.querySelector('.discount-choice');
        
        // Utiliser la valeur de l'option sélectionnée
        const discountValue = discountElement ? discountElement.value : null;
    
        // Sélectionner correctement le champ caché
        const discountFinalElement = document.getElementById('discount-final');
        if (discountFinalElement) {
            discountFinalElement.value = discountValue;  // Mettre à jour la valeur du champ caché
        } else {
            console.error('Champ caché discount-final non trouvé');
        }
    
        // Mettre à jour le FormData avec la nouvelle valeur de discount-final
        form.set('discount-final', discountValue);
    
        // Envoyer la requête AJAX via Axios
        axios.post(url, form)  // Envoie les données via AJAX
            .then(response => {
                if (response.data.newTotal) {
                    // Mettre à jour dynamiquement le total du panier dans le DOM
                    const totalElement = document.getElementById('cart-total');
                    if (totalElement) {
                        totalElement.innerText = `${response.data.newTotal} €`;
                        // Mettre à jour la valeur de l'input caché pour le total
                        document.getElementById('total-input').value = response.data.newTotal;
                    } else {
                        console.error('Total element not found');
                    }
                }
            })
            .catch(error => {
                console.error('Erreur lors de l\'application de la réduction :', error);
            });
    }
}