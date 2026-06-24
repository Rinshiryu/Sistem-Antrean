<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliMud Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-card">
            
            <div class="form-section">
                <div class="brand">
                    <img src="{{ asset('image/login/logos.png')}}" alt="Logo BaliMud" class="logo">
                    <h1>BaliMud</h1>
                </div>

                <form id="loginForm">
                    <div class="input-group">
                        <label for="phone">Nomor Telepon</label>
                        <div class="phone-wrapper">
                            <div class="country-code">
                                +62 
                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L5 5L9 1" stroke="#333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <input type="tel" id="phone" placeholder="8213426921" required>
                        </div>
                        <span class="helper-text">Pilih kode negara dan masukkan nomor handphone Anda tanpa diawali angka 0</span>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" required>
                            <button type="button" id="togglePassword" class="btn-toggle-pass">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-actions">
                        <span class="text-bold">Lupa Password?</span>
                        <a href="#" class="link-blue">Password Baru</a>
                    </div>

                    <button type="submit" class="btn-login">Login</button>

                    <div class="register-link">
                        <span class="text-bold">Belum punya akun?</span> <a href="#" class="link-blue">Daftar Baru</a>
                    </div>
                </form>
            </div>

            <div class="image-section">
                </div>

        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>