<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login | SAP ADHI</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('images/gedung-mth27.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 350px;
            position: relative;
        }

        .login-card h3 {
            font-weight: 600;
            color: #333;
            font-size: 1.25rem;
        }

        .login-card img {
            height: 70px;
        }

        .login-card input[type="email"],
        .login-card input[type="password"],
        .login-card input[type="text"] {
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            font-size: 0.9rem;
            height: 42px;
            line-height: 1.5;
        }

        .login-card input[type="email"]:focus,
        .login-card input[type="password"]:focus,
        .login-card input[type="text"]:focus {
            border-color: #ec1c24;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #ec1c24;
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #b5181a;
        }

        .form-check-label {
            font-size: 0.85rem;
            color: #666;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            z-index: 10;
        }

        .password-field {
            position: relative;
        }

        /* Spinner CSS */
        .spinner-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #f8f9fa; /* Warna latar belakang spinner */
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: #ec1c24; /* Warna animasi spinner */
            animation: spin 1s linear infinite;
        }

        .spinner-text {
            margin-top: 10px;
            color: #ec1c24; /* Warna teks spinner */
            font-weight: 500;
        }

        /* Efek rotasi spinner */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Menyembunyikan spinner ketika loading selesai */
        body:not(.loading) .spinner-container {
            opacity: 0;
            visibility: hidden;
        }

        /* Sembunyikan konten saat spinner tampil */
        body.loading .container {
            visibility: hidden;
        }

        /* Tampilkan konten saat loading selesai */
        body:not(.loading) .container {
            visibility: visible;
        }

        body:not(.loading) .login-card {
            visibility: visible;
        }

        /* CAPTCHA styles */
        #captcha-container {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 8px;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            user-select: none;
        }
    </style>
</head>
<body class="loading">
    <!-- Spinner Section -->
    <div class="spinner-container">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-text">Mohon tunggu...</div>
    </div>

    <!-- CAPTCHA Error Toast -->
    <div class="position-fixed" style="top: 70px; right: 20px; z-index: 1050;">
        <div id="captchaErrorToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000" style="background-color: #ec1c24;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-exclamation-circle-fill me-2"></i> CAPTCHA SALAH! CAPTCHA yang Anda masukkan salah. Silakan coba lagi.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Logout Success Notification -->
    @if (session('logout_success'))
        <div class="position-fixed" style="top: 70px; right: 20px; z-index: 1050;">
            <div id="logoutSuccessToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000" style="background-color: #ec1c24;">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-check-circle-fill me-2"></i> Logout berhasil! Anda telah keluar dari dashboard admin.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Login Form -->
    <div class="login-card text-center">
        <img src="{{ asset('images/adhi-karya.png') }}" alt="Logo Adhi Karya">
        <h3 class="mt-3">Admin Login</h3>

        <form method="POST" action="{{ route('admin.login') }}" id="loginForm">
            @csrf
            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3 password-field">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan password" required>
                <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
                @error('password')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <!-- CAPTCHA -->
            <div class="form-group mb-3">
                <div id="captcha-container"></div>
                <input type="text" name="captcha" class="form-control" id="captcha-input" placeholder="Masukkan CAPTCHA" required>
            </div>

            <div class="form-check mb-4 text-start">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Ingat Saya</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Show/Hide Password, Spinner, Remember Me, and CAPTCHA functionality -->
    <script>
        // Spinner hide function
        window.addEventListener('load', function() {
            document.body.classList.remove('loading');

            var logoutSuccessToast = document.getElementById('logoutSuccessToast');
            if (logoutSuccessToast) {
                var toast = new bootstrap.Toast(logoutSuccessToast);
                toast.show();
            }

            var loginSuccessToast = document.getElementById('loginSuccessToast');
            if (loginSuccessToast) {
                var toast = new bootstrap.Toast(loginSuccessToast);
                toast.show();
            }
        });

        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        // Simpan data login
        function saveLoginData() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;

            if (remember) {
                localStorage.setItem('rememberedEmail', email);
                localStorage.setItem('rememberedPassword', password);
                localStorage.setItem('rememberMe', 'true');
            } else {
                localStorage.removeItem('rememberedEmail');
                localStorage.removeItem('rememberedPassword');
                localStorage.removeItem('rememberMe');
            }
        }

        // Isi form dengan data yang tersimpan
        function fillLoginForm() {
            const rememberedEmail = localStorage.getItem('rememberedEmail');
            const rememberedPassword = localStorage.getItem('rememberedPassword');
            const rememberMe = localStorage.getItem('rememberMe');

            if (rememberedEmail) {
                document.getElementById('email').value = rememberedEmail;
            }

            if (rememberedPassword) {
                document.getElementById('password').value = rememberedPassword;
            }

            if (rememberMe === 'true') {
                document.getElementById('remember').checked = true;
            }
        }

        // Panggil fungsi fillLoginForm saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fillLoginForm);

        // Tambahkan event listener untuk form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            // Validasi CAPTCHA dengan case-sensitive
            if (!validateCaptcha()) {
                e.preventDefault(); // Cegah submit jika CAPTCHA salah
                
                // Tampilkan notifikasi CAPTCHA salah
                var captchaErrorToast = document.getElementById('captchaErrorToast');
                var toast = new bootstrap.Toast(captchaErrorToast);
                toast.show();

                generateCaptcha(); // Buat CAPTCHA baru
            } else {
                saveLoginData(); // Simpan data login jika CAPTCHA benar
            }
        });

        // CAPTCHA functions
        function generateCaptcha() {
            const captchaContainer = document.getElementById('captcha-container');
            const characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
            let captcha = '';
            for (let i = 0; i < 6; i++) {
                captcha += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            captchaContainer.textContent = captcha; // Tampilkan tanpa spasi
        }

        // Fungsi validasi CAPTCHA (case-sensitive)
        function validateCaptcha() {
            const captchaContainer = document.getElementById('captcha-container');
            const captchaInput = document.getElementById('captcha-input');

            // Perbandingan langsung (case-sensitive)
            return captchaContainer.textContent === captchaInput.value;
        }

        // Generate CAPTCHA when page loads
        document.addEventListener('DOMContentLoaded', generateCaptcha);
    </script>
</body>
</html>