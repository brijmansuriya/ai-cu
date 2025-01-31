import './bootstrap';
import Alpine from 'alpinejs';
import jQuery from 'jquery';
import 'datatables.net-bs5';
import Swal from 'sweetalert2';
import './admin/status-toggle';
import './admin/delete-record';

window.Alpine = Alpine;
window.$ = window.jQuery = jQuery;
window.Swal = Swal;

// Ensure jQuery is available globally
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOMContentLoaded');
    console.log('jQuery Loaded:', !!window.$); // Verify jQuery is loaded
    console.log('Swal Loaded:', !!window.Swal);
    console.log('Alpine Loaded:', !!window.Alpine);
});
Alpine.start();
