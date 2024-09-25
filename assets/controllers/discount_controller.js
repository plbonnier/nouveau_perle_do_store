import { Controller } from '@hotwired/stimulus';
import axios from 'axios';

export default class extends Controller {
    static targets = ['total'];

    applyDiscount(event) {
        event.preventDefault();  // Empêche la soumission classique du formulaire

        const form = new FormData(event.target);  // Récupère les données du formulaire
        const url = event.target.action;  // URL où envoyer la requête

        axios.post(url, form)  // Envoie les données via AJAX
            .then(response => {
                if (response.data.newTotal) {
                    // Mettre à jour dynamiquement le total du panier dans le DOM
                    document.getElementById('cart-total').innerText = `${response.data.newTotal} €`;
                }
            })
            .catch(error => {
                console.error('Erreur lors de l\'application de la réduction :', error);
            });
    }
}