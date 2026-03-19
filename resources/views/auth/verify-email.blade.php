<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - Regret Consultancy</title>
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
    
    <!-- Right Side - Email Verification Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 bg-[#0f172a]">
        <div class="w-full max-w-md">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#0ea5a4]/20 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 teal-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold teal-accent mb-2">Verify Your Email</h1>
                <p class="text-[#e5e7eb]">We've sent a verification link to your email</p>
            </div>
            
            @if(session('message'))
            <div class="bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
            @endif
            
            <div class="bg-[#1e293b] rounded-lg p-6 mb-6">
                <p class="text-gray-300 text-center mb-4">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
                </p>
                <p class="text-gray-400 text-sm text-center">
                    If you didn't receive the email, we will gladly send you another.
                </p>
            </div>
            
            <form method="POST" action="{{ route('verification.resend') }}" class="mb-4">
                @csrf
                <button type="submit" class="w-full teal-bg teal-bg-hover text-white font-semibold py-3 px-4 rounded-lg">
                    Resend Verification Email
                </button>
            </form>
            
            <div class="flex gap-3">
                <a href="/registration" class="flex-1 text-center bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-lg transition">
                    ← Back to Register
                </a>
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


