/**
 * Class AuthController
 * Menangani logika interaksi UI untuk halaman autentikasi.
 */
class AuthController {
    constructor(formId) {
        // Inisialisasi elemen DOM
        this.form = document.getElementById(formId);
        this.passwordInput = document.getElementById('password');
        this.toggleBtn = document.getElementById('togglePassword');
        this.phoneInput = document.getElementById('phone');

        // Binding events saat class diinisialisasi
        this.initEvents();
    }

    // Method untuk mengelompokkan event listeners
    initEvents() {
        if (this.toggleBtn) {
            this.toggleBtn.addEventListener('click', () => this.togglePasswordVisibility());
        }

        if (this.form) {
            this.form.addEventListener('submit', (e) => this.handleLoginSubmit(e));
        }
    }

    // Method untuk toggle show/hide password
    togglePasswordVisibility() {
        const isPassword = this.passwordInput.type === 'password';
        this.passwordInput.type = isPassword ? 'text' : 'password';
        
        // Opsional: Kamu bisa mengganti ikon SVG di sini saat di-toggle
        // Namun fungsi dasar show/hide sudah berjalan.
    }

    // Method untuk menangani proses submit (simulasi)
    handleLoginSubmit(event) {

        const passVal = this.passwordInput.value;

        if (!passVal.trim()) {
            event.preventDefault();
            alert('Password harus diisi!');
            return;
        }

    }
}

// Inisialisasi class ketika Document Object Model sudah siap
document.addEventListener('DOMContentLoaded', () => {
    // Membuat instance baru dari AuthController
    const loginApp = new AuthController('loginForm');
});