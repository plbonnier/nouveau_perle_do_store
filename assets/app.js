/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
// import './bootstrap';

import { Application } from '@hotwired/stimulus';
import QuantityController from './controllers/quantity_controller';
import DiscountController from './controllers/discount_controller';
import ModalController from './controllers/modal_controller';
import CartController from './controllers/cart_controller';

const application = Application.start();
application.register('quantity', QuantityController);
application.register('discount', DiscountController);
application.register('modal', ModalController);
application.register('cart', CartController);


document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Display a message to the user instead of using console.log
            alert('Formulaire soumis');
            this.submit();
        });
    }
});