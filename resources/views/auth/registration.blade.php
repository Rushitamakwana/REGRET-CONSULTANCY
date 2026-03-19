
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Regret Consultancy</title>
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
    
    <!-- Right Side - Register Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#0f172a] overflow-y-auto">
        <div class="w-full max-w-lg">
            <div class="text-center mt-10">
<h1 class="text-3xl font-bold text-red-500 mb-2">Registration Disabled</h1>
                <p class="text-[#e5e7eb]">Contact super admin for access. Only super admin login allowed.</p>
            </div>
            
            <form method="POST" action="/register" id="registerForm" class="space-y-4" autocomplete="on">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-[#e5e7eb] mb-2">Full Name</label>
                    <input type="text" name="name" id="name" autocomplete="name" class="w-full px-4 py-3 rounded-lg text-gray-400" placeholder="Enter your full name">
                    <div id="nameError" class="error-message hidden">Name must be at least 2 characters</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-[#e5e7eb] mb-2">Email Address</label>
                    <input type="email" name="email" id="email" autocomplete="email" class="w-full px-4 py-3 rounded-lg text-gray-400" placeholder="Enter your email">
                    <div id="emailError" class="error-message hidden">Please enter a valid email address</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-[#e5e7eb] mb-2">Password</label>
                    <input type="password" name="password" id="password" autocomplete="new-password" class="w-full px-4 py-3 rounded-lg text-gray-400" placeholder="Create a password">
                    <div id="passwordError" class="error-message hidden">Password must be at least 6 characters</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-[#e5e7eb] mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="passwordConfirmation" autocomplete="new-password" class="w-full px-4 py-3 rounded-lg text-gray-400" placeholder="Confirm your password">
                    <div id="passwordConfirmationError" class="error-message hidden">Passwords do not match</div>
                </div>
                
                <div class="flex items-start">
                    <input type="checkbox" name="terms" id="terms" class="w-4 h-4 mt-1 rounded border-gray-600 bg-[#1e293b] text-[#0ea5a4]">
                    <label class="ml-2 text-sm text-[#e5e7eb]">
                        I agree to the <a href="#" class="teal-accent hover:underline">Terms</a> and <a href="#" class="teal-accent hover:underline">Privacy Policy</a>
                    </label>
                </div>
                <div id="termsError" class="error-message hidden">You must agree to the terms</div>

                @if($errors->any())
                <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded">
                    {{ $errors->first() }}
                </div>
                @endif
                
                <button type="submit" class="w-full teal-bg teal-bg-hover text-white font-semibold py-3 px-4 rounded-lg">
                    Create Account
                </button>
            </form>
            
            <p class="text-center mt-6 text-[#e5e7eb]">
                Already have an account? 
                <a href="/login" class="teal-accent font-semibold hover:underline">Sign in</a>
            </p>
        </div>
    </div>

    <script>
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('passwordConfirmation');
        const termsInput = document.getElementById('terms');
        
        const nameError = document.getElementById('nameError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const passwordConfirmationError = document.getElementById('passwordConfirmationError');
        const termsError = document.getElementById('termsError');

        function validatePassword(password) {
            const minLength = 8;
            const maxLength = 12;
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
            
            if (password.length < minLength) return 'Password must be at least 8 characters';
            if (password.length > maxLength) return 'Password must be at most 12 characters';
            if (!hasUppercase) return 'Password must contain at least 1 uppercase letter';
            if (!hasLowercase) return 'Password must contain at least 1 lowercase letter';
            if (!hasNumber) return 'Password must contain at least 1 number';
            if (!hasSpecial) return 'Password must contain at least 1 special character';
            
            return null;
        }

        function validateEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        function showError(input, errorEl, message) {
            input.classList.add('error-border');
            errorEl.classList.remove('hidden');
            if (message) errorEl.textContent = message;
        }

        function hideError(input, errorEl) {
            input.classList.remove('error-border');
            errorEl.classList.add('hidden');
        }

        // Name validation
        nameInput.addEventListener('input', function() {
            if (this.value.length >= 2) {
                hideError(this, nameError);
            }
        });

        nameInput.addEventListener('blur', function() {
            if (this.value.length === 0) {
                showError(this, nameError, 'Name is required');
            } else if (this.value.length < 2) {
                showError(this, nameError, 'Name must be at least 2 characters');
            } else {
                hideError(this, nameError);
            }
        });

        // Email validation
        emailInput.addEventListener('input', function() {
            if (this.value.length > 0 && validateEmail(this.value)) {
                hideError(this, emailError);
            }
        });

        emailInput.addEventListener('blur', function() {
            if (this.value.length === 0) {
                showError(this, emailError, 'Email is required');
            } else if (!validateEmail(this.value)) {
                showError(this, emailError, 'Please enter a valid email address');
            } else {
                hideError(this, emailError);
            }
        });

        // Password validation
        passwordInput.addEventListener('input', function() {
            const error = validatePassword(this.value);
            if (error) {
                showError(this, passwordError, error);
            } else {
                hideError(this, passwordError);
            }
        });

        passwordInput.addEventListener('blur', function() {
            const error = validatePassword(this.value);
            if (error) {
                showError(this, passwordError, error);
            } else if (this.value.length === 0) {
                showError(this, passwordError, 'Password is required');
            } else {
                hideError(this, passwordError);
            }
        });

        // Password confirmation validation
        passwordConfirmationInput.addEventListener('input', function() {
            if (this.value === passwordInput.value) {
                hideError(this, passwordConfirmationError);
            }
        });

        passwordConfirmationInput.addEventListener('blur', function() {
            if (this.value.length === 0) {
                showError(this, passwordConfirmationError, 'Please confirm your password');
            } else if (this.value !== passwordInput.value) {
                showError(this, passwordConfirmationError, 'Passwords do not match');
            } else {
                hideError(this, passwordConfirmationError);
            }
        });

        // Terms validation
        termsInput.addEventListener('change', function() {
            if (this.checked) {
                hideError(this, termsError);
            }
        });

        // Form submit validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let valid = true;
            
            // Validate name
            if (nameInput.value.length === 0) {
                showError(nameInput, nameError, 'Name is required');
                valid = false;
            } else if (nameInput.value.length < 2) {
                showError(nameInput, nameError, 'Name must be at least 2 characters');
                valid = false;
            }
            
            // Validate email
            if (emailInput.value.length === 0) {
                showError(emailInput, emailError, 'Email is required');
                valid = false;
            } else if (!validateEmail(emailInput.value)) {
                showError(emailInput, emailError, 'Please enter a valid email address');
                valid = false;
            }
            
            // Validate password
            const passwordErrorMsg = validatePassword(passwordInput.value);
            if (passwordInput.value.length === 0) {
                showError(passwordInput, passwordError, 'Password is required');
                valid = false;
            } else if (passwordErrorMsg) {
                showError(passwordInput, passwordError, passwordErrorMsg);
                valid = false;
            }
            
            // Validate password confirmation
            if (passwordConfirmationInput.value.length === 0) {
                showError(passwordConfirmationInput, passwordConfirmationError, 'Please confirm your password');
                valid = false;
            } else if (passwordConfirmationInput.value !== passwordInput.value) {
                showError(passwordConfirmationInput, passwordConfirmationError, 'Passwords do not match');
                valid = false;
            }
            
            // Validate terms
            if (!termsInput.checked) {
                showError(termsInput, termsError, 'You must agree to the terms');
                valid = false;
            }
            
            if (!valid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>

