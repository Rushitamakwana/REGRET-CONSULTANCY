
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Regret Consultancy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #0f172a;
        }
        .teal-accent {
            color: #0ea5a4;
        }
        .teal-bg {
            background-color: #0ea5a4;
        }
        .teal-bg-hover:hover {
            background-color: #0d9488;
        }
        input {
            background-color: #1e293b;
            border: 1px solid #334155;
            color: #e5e7eb;
        }
        input:focus {
            border-color: #0ea5a4;
            outline: none;
        }
        input::placeholder {
            color: #94a3b8;
        }
        .error-border {
            border-color: #ef4444 !important;
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="h-screen flex">
    <!-- Left Side - Image -->
    <div class="hidden lg:flex lg:w-1/2 bg-[#0ea5a4] items-center justify-center">
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop" alt="Regret Consultancy" class="w-full h-full object-cover">
    </div>
    
    <!-- Right Side - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#0f172a]">
        <div class="w-full max-w-lg">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold teal-accent mb-2">Regret Consultancy</h1>
                <p class="text-[#e5e7eb]">Sign in to your account</p>
            </div>
            
            <form method="POST" action="/login" id="loginForm" class="space-y-5" autocomplete="on">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-[#e5e7eb] mb-2">Email Address</label>
                    <input type="email" name="email" id="email" autocomplete="username" class="w-full px-4 py-3 rounded-lg text-gray-400" placeholder="Enter your email">
                    <div id="emailError" class="error-message hidden">Please enter a valid email address</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-[#e5e7eb] mb-2">Password</label>
                    <input type="password" name="password" id="password" autocomplete="current-password" class="w-full px-4 py-3 rounded-lg text-gray-400" placeholder="Enter your password">
                    <div id="passwordError" class="error-message hidden">Password is required</div>
                </div>
                
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-600 bg-[#1e293b] text-[#0ea5a4]">
                        <span class="ml-2 text-sm text-[#e5e7eb]">Remember me</span>
                    </label>
                    <a href="/forgot-password" class="text-sm teal-accent hover:underline">Forgot password?</a>
                </div>

                @if($errors->any())
                <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded">
                    {{ $errors->first() }}
                </div>
                @endif
                
                @if(Session::has('error'))
                <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded">
                    {{ Session::get('error') }}
                </div>
                @endif
                
                <button type="submit" class="w-full teal-bg teal-bg-hover text-white font-semibold py-3 px-4 rounded-lg">
                    Sign In
                </button>
            </form>
            
            <p class="text-center mt-6 text-[#e5e7eb]">
                Don't have an account? 
                Contact super admin for access
            </p>
        </div>
    </div>

    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        function validateEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        function showError(input, errorEl) {
            input.classList.add('error-border');
            errorEl.classList.remove('hidden');
        }

        function hideError(input, errorEl) {
            input.classList.remove('error-border');
            errorEl.classList.add('hidden');
        }

        emailInput.addEventListener('input', function() {
            if (this.value.length > 0 && !validateEmail(this.value)) {
                showError(this, emailError);
            } else {
                hideError(this, emailError);
            }
        });

        emailInput.addEventListener('blur', function() {
            if (this.value.length > 0 && !validateEmail(this.value)) {
                showError(this, emailError);
            } else if (this.value.length === 0) {
                showError(this, emailError);
                emailError.textContent = 'Email is required';
            } else {
                hideError(this, emailError);
            }
        });

        passwordInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                hideError(this, passwordError);
            }
        });

        passwordInput.addEventListener('blur', function() {
            if (this.value.length === 0) {
                showError(this, passwordError);
                passwordError.textContent = 'Password is required';
            } else {
                hideError(this, passwordError);
            }
        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            let valid = true;
            
            if (!validateEmail(emailInput.value)) {
                showError(emailInput, emailError);
                emailError.textContent = emailInput.value.length === 0 ? 'Email is required' : 'Please enter a valid email address';
                valid = false;
            }
            
            if (passwordInput.value.length === 0) {
                showError(passwordInput, passwordError);
                valid = false;
            }
            
            if (!valid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>

