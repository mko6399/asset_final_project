import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2/dist/sweetalert2.js';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('alpine:init', () => {
    Alpine.data('imageUploader', () => ({
        imagePreviews: [],

        handleImagePreview(event) {
            this.imagePreviews = [];
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                this.imagePreviews.push(URL.createObjectURL(files[i]));
            }
        }
    }));
});
