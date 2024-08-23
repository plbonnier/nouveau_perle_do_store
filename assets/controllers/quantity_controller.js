import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['quantity'];

    connect() {
        console.log('Quantity controller connected');
    }

    increment(event) {
        event.preventDefault();
        console.log('Increment clicked');
        this.updateQuantity(1);
    }

    decrement(event) {
        event.preventDefault();
        console.log('Decrement clicked');
        this.updateQuantity(-1);
    }

    updateQuantity(amount) {
        const currentValue = parseInt(this.quantityTarget.value, 10);
        const newValue = currentValue + amount;
        this.quantityTarget.value = newValue >= 0 ? newValue : 0;
    }
}