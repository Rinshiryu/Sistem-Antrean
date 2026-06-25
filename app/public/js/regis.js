/**
 * Class RegisterController
 * Menangani interaksi dan validasi dasar untuk form registrasi
 */
class RegisterController {
    constructor(formId) {
        this.form = document.getElementById(formId);
        // Mengambil semua tombol toggle password di halaman ini
        this.toggleButtons = document.querySelectorAll('.btn-toggle-pass');
        
        // Input fields untuk divalidasi
        this.passwordInput = document.getElementById('reg-password');
        this.confirmPasswordInput = document.getElementById('reg-confirm-password');

        this.initEvents();
    }

    initEvents() {
        // Melakukan loop untuk memasang event pada tiap tombol toggle
        this.toggleButtons.forEach(button => {
            button.addEventListener('click', (e) => this.togglePasswordVisibility(e));
        });

        if (this.form) {
            this.form.addEventListener('submit', (e) => this.handleRegisterSubmit(e));
        }
    }

    // Method untuk show/hide password dinamis berdasarkan data-target
    togglePasswordVisibility(event) {
        // Mencari tombol yang diklik (mengatasi klik pada icon SVG di dalam button)
        const button = event.currentTarget;
        
        // Mengambil ID target dari atribut data-target
        const targetId = button.getAttribute('data-target');
        const targetInput = document.getElementById(targetId);

        if (targetInput) {
            const isPassword = targetInput.type === 'password';
            targetInput.type = isPassword ? 'text' : 'password';
        }
    }

    // Method untuk validasi dan submit form
    handleRegisterSubmit(event) {

        const passVal = this.passwordInput.value;
        const confirmPassVal = this.confirmPasswordInput.value;

        if (passVal !== confirmPassVal) {
            event.preventDefault();

            alert('Password dan Konfirmasi Password tidak cocok!');
            return;
        }
    }
}

// Inisialisasi DOM
document.addEventListener('DOMContentLoaded', () => {
    const registerApp = new RegisterController('registerForm');
});