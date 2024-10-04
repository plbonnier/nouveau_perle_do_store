import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['productTotal'];

    updateProductTotal(total) {
        if (total !== undefined) {
            this.productTotalTarget.textContent = total;
        } else {
            console.error('Total products is undefined');
        }
    }
}