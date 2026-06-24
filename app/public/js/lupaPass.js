/**
 * Class ForgotPasswordController
 * Menangani logika interaksi form untuk halaman Lupa Password.
 */
class ForgotPasswordController {
    constructor(formId) {
        // Inisialisasi elemen form dan input
        this.form = document.getElementById(formId);
        this.phoneInput = document.getElementById('forgot-phone');

        // Jalankan binding event
        this.initEvents();
    }

    // Mengikat event listener ke form
    initEvents() {
        if (this.form) {
            this.form.addEventListener('submit', (e) => this.handleValidationSubmit(e));
        }
    }

    // Method untuk memproses submit
    handleValidationSubmit(event) {
        event.preventDefault(); // Mencegah reload halaman standar

        const phoneVal = this.phoneInput.value.trim();

        // Validasi sederhana memastikan input tidak kosong
        if (!phoneVal) {
            alert('Gagal: Nomor handphone wajib diisi!');
            return;
        }

        // Simulasi proses validasi API via OOP
        console.log(`[OOP] Proses Validasi Nomor:`);
        console.log(`Target: +62${phoneVal}`);
        
        // Notifikasi ke user
        alert(`Berhasil!\nInstruksi untuk membuat password baru akan dikirimkan ke nomor: +62${phoneVal}`);
    }
}

// Inisialisasi class ketika halaman HTML selesai dimuat
document.addEventListener('DOMContentLoaded', () => {
    const forgotApp = new ForgotPasswordController('forgotPasswordForm');
});