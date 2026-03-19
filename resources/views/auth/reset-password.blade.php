<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Regret Consultancy</title>
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
    
    <!-- Right Side - Reset Password Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#0f172a]">
        <div class="w-full max-w-lg">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold teal-accent mb-2">Reset Password</h1>
                <p class="text-[#e5e7eb]">Enter your new password</p>
            </div>
            
            @if($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
            @endif
            
            <form method="POST" action="/reset-password" id="resetPasswordForm" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div>
                    <label class="block text-sm font-medium text-[#e5e7eb] mb-2">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-3 rounded-lg text-gray-400" placeholder="Enter your email" value="{{ old('email') }}">
                    <div id="emailError" class="error-message hidden">Please enter a valid email address</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-[#e5e7eb] mb-2">New Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-lg text-gray-400" placeholder="Enter new password">
                    <div id="passwordError" class="error-message hidden">Password is required</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-[#e5e7eb] mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="passwordConfirmation" class="w-full px-4 py-3 rounded-lg text-gray-400" placeholder="Confirm new password">
                    <div id="confirmError" class="error-message hidden">Passwords do not match</div>
                </div>
                
                <button type="submit" class="w-full teal-bg teal-bg-hover text-white font-semibold py-3 px-4 rounded-lg">
                    Reset Password
                </button>
            </form>
            
            <p class="text-center mt-6 text-[#e5e7eb]">
                Remember your password? 
                <a href="/login" class="teal-accent font-semibold hover:underline">Sign in</a>
            </p>
        </div>
    </div>

    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('passwordConfirmation');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const confirmError = document.getElementById('confirmError');

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

        confirmInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                hideError(this, confirmError);
            }
        });

        confirmInput.addEventListener('blur', function() {
            if (this.value.length === 0) {
                showError(this, confirmError);
                confirmError.textContent = 'Please confirm your password';
            } else if (this.value !== passwordInput.value) {
                showError(this, confirmError);
                confirmError.textContent = 'Passwords do not match';
            } else {
                hideError(this, confirmError);
            }
        });

        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
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
            
            if (confirmInput.value.length === 0) {
                showError(confirmInput, confirmError);
                confirmError.textContent = 'Please confirm your password';
                valid = false;
            } else if (confirmInput.value !== passwordInput.value) {
                showError(confirmInput, confirmError);
                confirmError.textContent = 'Passwords do not match';
                valid = false;
            }
            
            if (!valid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>

