<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISP Billing Login - NetBill Pro</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { jakarta: ['Plus Jakarta Sans', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: linear-gradient(135deg, #0f1629 0%, #0a0e1a 100%); }
        .login-container {
            background: linear-gradient(135deg, #1a202c 0%, #0f1629 100%);
            border: 1px solid rgba(99, 102, 241, 0.2);
            backdrop-filter: blur(10px);
        }
        .input-field {
            background: rgba(31, 41, 55, 0.8);
            border: 1px solid rgba(75, 85, 99, 0.4);
            transition: all 0.3s;
        }
        .input-field:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: rgba(31, 41, 55, 0.95);
        }
        .login-btn {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            transition: all 0.3s;
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }
        .login-btn:active {
            transform: translateY(0);
        }
        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            display: none;
        }
        .error-message.show {
            display: block;
        }
        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #a7f3d0;
            display: none;
        }
        .success-message.show {
            display: block;
        }
        .remember-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #6366f1;
        }
        .form-divider {
            background: linear-gradient(to right, transparent, rgba(99, 102, 241, 0.2), transparent);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                    <i data-lucide="wifi" class="w-8 h-8 text-white"></i>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">NetBill Pro</h1>
            <p class="text-gray-400 text-sm">ISP Billing Management System</p>
        </div>

        <!-- Login Form Container -->
        <div class="login-container rounded-2xl p-8 shadow-2xl">
            <!-- Error Message -->
            <div id="errorMessage" class="error-message rounded-lg p-4 mb-6 flex items-center gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                <span id="errorText"></span>
            </div>

            <!-- Success Message -->
            <div id="successMessage" class="success-message rounded-lg p-4 mb-6 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <span id="successText">Login berhasil! Redirecting...</span>
            </div>

            <form id="loginForm" onsubmit="handleLogin(event)">
                <!-- Email / Username Field -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email atau Username</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-3 top-3 w-5 h-5 text-gray-500"></i>
                        <input 
                            type="text" 
                            id="email" 
                            name="email" 
                            placeholder="admin@isp.net atau username" 
                            class="input-field w-full pl-10 pr-4 py-3 rounded-lg text-white placeholder-gray-600"
                            required
                            autocomplete="email"
                        >
                    </div>
                    <span id="emailError" class="text-red-400 text-xs mt-1 block hidden"></span>
                </div>

                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-3 top-3 w-5 h-5 text-gray-500"></i>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda" 
                            class="input-field w-full pl-10 pr-12 py-3 rounded-lg text-white placeholder-gray-600"
                            required
                            autocomplete="current-password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility()" 
                            class="absolute right-3 top-3 text-gray-500 hover:text-gray-300 transition"
                        >
                            <i data-lucide="eye" class="w-5 h-5" id="eyeIcon"></i>
                        </button>
                    </div>
                    <span id="passwordError" class="text-red-400 text-xs mt-1 block hidden"></span>
                </div>

                <!-- Remember & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input 
                            type="checkbox" 
                            id="rememberMe" 
                            name="remember_me" 
                            class="remember-checkbox rounded"
                        >
                        <span class="text-sm text-gray-400">Ingat saya</span>
                    </label>
                    <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300 transition">Lupa password?</a>
                </div>

                <!-- Login Button -->
                <button 
                    type="submit" 
                    id="loginBtn" 
                    class="login-btn w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg flex items-center justify-center gap-2"
                >
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                    <span id="btnText">Masuk</span>
                </button>
            </form>

            <!-- Divider -->
            <div class="form-divider h-px my-6"></div>

            <!-- Additional Links -->
            <div class="space-y-2">
                <button type="button" class="w-full py-2.5 border border-gray-700 hover:border-gray-600 rounded-lg text-gray-300 text-sm transition flex items-center justify-center gap-2">
                    <i data-lucide="shield" class="w-4 h-4"></i>
                    Daftar Akun Baru
                </button>
                <button type="button" class="w-full py-2.5 border border-gray-700 hover:border-gray-600 rounded-lg text-gray-300 text-sm transition flex items-center justify-center gap-2">
                    <i data-lucide="headphones" class="w-4 h-4"></i>
                    Hubungi Support
                </button>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-gray-500 text-xs mb-3">Informasi Keamanan</p>
            <div class="flex items-center justify-center gap-3 text-xs text-gray-600">
                <span class="flex items-center gap-1">
                    <i data-lucide="shield-check" class="w-4 h-4 text-green-500"></i>
                    SSL Encrypted
                </span>
                <span class="text-gray-700">•</span>
                <span class="flex items-center gap-1">
                    <i data-lucide="lock" class="w-4 h-4 text-blue-500"></i>
                    Password Protected
                </span>
                <span class="text-gray-700">•</span>
                <span class="flex items-center gap-1">
                    <i data-lucide="eye-off" class="w-4 h-4 text-purple-500"></i>
                    Private
                </span>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Toggle password visibility
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordField.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }

        // Handle login
        async function handleLogin(event) {
            event.preventDefault();
            
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('rememberMe').checked;
            const loginBtn = document.getElementById('loginBtn');
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');
            const btnText = document.getElementById('btnText');
            
            // Clear previous messages
            errorMessage.classList.remove('show');
            successMessage.classList.remove('show');
            
            // Validation
            if (!email || !password) {
                showError('Email dan password tidak boleh kosong');
                return;
            }
            
            if (password.length < 6) {
                showError('Password minimal 6 karakter');
                return;
            }
            
            // Disable button during login
            loginBtn.disabled = true;
            btnText.textContent = 'Sedang masuk...';
            
            try {
                // Replace this with your actual Laravel API endpoint
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'include',
                    body: JSON.stringify({
                        email: email,
                        password: password,
                        remember: rememberMe
                    })
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    // Login successful
                    successMessage.classList.add('show');
                    
                    // Save token if provided
                    if (data.token) {
                        localStorage.setItem('auth_token', data.token);
                        localStorage.setItem('user', JSON.stringify(data.user));
                    }
                    
                    // Redirect after 1.5 seconds
                    setTimeout(() => {
                        window.location.href = data.redirect || '/dashboard';
                    }, 1500);
                } else {
                    // Login failed
                    showError(data.message || 'Login gagal. Periksa email dan password Anda.');
                    loginBtn.disabled = false;
                    btnText.textContent = 'Masuk';
                }
            } catch (error) {
                console.error('Login error:', error);
                showError('Terjadi kesalahan. Silakan coba lagi.');
                loginBtn.disabled = false;
                btnText.textContent = 'Masuk';
            }
        }
        
        // Show error message
        function showError(message) {
            const errorMessage = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            errorText.textContent = message;
            errorMessage.classList.add('show');
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                errorMessage.classList.remove('show');
            }, 5000);
        }
        
        // Check if user is already logged in
        window.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('auth_token');
            if (token) {
                // User is already logged in, redirect to dashboard
                window.location.href = '/dashboard';
            }
            lucide.createIcons();
        });
    </script>
</body>
</html>
