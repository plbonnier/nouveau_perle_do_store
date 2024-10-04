import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['productTotal'];

    updateProductTotal(total) {
        console.log('Updating product total:', total);
        if (total !== undefined) {
            this.productTotalTarget.textContent = total;
        } else {
            console.error('Total products is undefined');
        }
    }
}