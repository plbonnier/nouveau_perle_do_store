import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['modalElement'];

    connect() {
        console.log('ModalController connected');
    }

    open(event) {
        event.preventDefault();
        console.log('Open modal');
        console.log('Modal target:', this.modalElementTarget);
        if (this.hasModalElementTarget) {
            this.modalElementTarget.showModal();
        } else {
            console.error('Modal element target not found');
        }
    }

    close(event) {
        event.preventDefault();
        console.log('Close modal');
        if (this.hasModalElementTarget) {
            this.modalElementTarget.close();
        } else {
            console.error('Modal element target not found');
        }
    }
}