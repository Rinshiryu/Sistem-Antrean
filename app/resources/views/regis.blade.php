<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliMud Registrasi</title>
    <link rel="icon" type="image/png" href="{{ asset('image/login/logors.png') }}">
    <link rel="stylesheet" href="{{ asset('css/regis.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="register-card">
            
            <div class="register-header">
                <h2>Selamat datang di BaliMud.</h2>
                <p>Silahkan isi nomor handphone, nama akun dan buat password.</p>
            </div>

            <form id="registerForm" method="POST" action="{{ route('register') }}" >
                @csrf
                <!-- Baris 1: No Telepon & Nama -->
                <div class="form-row">
                    <!-- Input Nomor Telepon -->
                    <div class="input-group">
                        <label for="reg-phone">Nomor Telepon</label>
                        <div class="input-wrapper phone-wrapper">
                            <div class="country-code">
                                +62 
                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L5 5L9 1" stroke="#333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <input type="tel" id="reg-phone" name="phone" placeholder="8213426921" required>
                        </div>
                        <span class="helper-text">Pilih kode negara dan masukkan nomor handphone Anda tanpa diawali angka 0</span>
                    </div>

                    <!-- Input Username -->
                    <div class="input-group">
                        <label for="reg-username">Username</label>
                        <div class="input-wrapper">
                            <input type="text" id="reg-username" name="username" placeholder="Username" required>
                        </div>
                    </div>
                </div>

                <!-- Baris 2: Password & Konfirmasi Password -->
                <div class="form-row">
                    <!-- Input Password -->
                    <div class="input-group">
                        <label for="reg-password">Password</label>
                        <div class="input-wrapper password-wrapper">
                            <input type="password" id="reg-password" name="password" required>
                            <button type="button" class="btn-toggle-pass" data-target="reg-password">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="input-group">
                        <label for="reg-confirm-password">Konfirmasi Password</label>
                        <div class="input-wrapper password-wrapper">
                            <input type="password" id="reg-confirm-password" name="password_confirmation" required>
                            <button type="button" class="btn-toggle-pass" data-target="reg-confirm-password">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tombol Daftar -->
                 @if ($errors->any())
                    <div style="color:red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="btn-container">
                    <button type="submit" class="btn-primary">Daftar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/regis.js') }}"></script>
</body>
</html>