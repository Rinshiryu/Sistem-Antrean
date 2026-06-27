<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliMud Lupa Password</title>
    <link rel="icon" type="image/png" href="{{ asset('image/login/logors.png') }}">
    <link rel="stylesheet" href="{{ asset('css/lupaPass.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-card">
            
            <div class="form-section">
                <div class="forgot-header">
                    <h2>Masukkan Nomor Handphone anda untuk melakukan validasi.</h2>
                </div>

                <form id="forgotPasswordForm">
                    <div class="input-group">
                        <label for="forgot-phone">Nomor Telepon</label>
                        <div class="phone-wrapper">
                            <div class="country-code">
                                +62 
                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L5 5L9 1" stroke="#333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <input type="tel" id="forgot-phone" placeholder="8213426921" required>
                        </div>
                        <span class="helper-text">Pilih kode negara dan masukkan nomor handphone Anda tanpa diawali angka 0</span>
                    </div>

                    <button type="submit" class="btn-login btn-lanjutkan">Lanjutkan</button>
                </form>
            </div>

            <div class="image-section">
                </div>

        </div>
    </div>

    <script src="{{ asset('js/lupaPass.js') }}"></script>
</body>
</html>