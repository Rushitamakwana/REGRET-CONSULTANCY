<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile - {{ ucfirst(Auth::user()->role ?? 'admin') }} Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { 
                extend: { 
                    colors: { 
                        primary: '#0257b3',
                        'primary-hover': '#0d9488'
                    } 
                } 
            }
        }
    </script>
    <style>
        :root {
            --secondary: #0f172a;
        }
        body { background-color: #f1f5f9; }
        .sidebar { background-color: var(--secondary); }
        .topbar { background-color: var(--secondary); }
        .file-input::-webkit-file-upload-button {
            background-color: #0257b3 !important;
            color: white !important;
            border: none !important;
            padding: 0.5rem 1rem !important;
            border-radius: 0.75rem !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: background-color 0.2s !important;
        }
        .file-input::-webkit-file-upload-button:hover {
            background-color: #0d9488 !important;
        }
    </style>
</head>
<body class="font-sans">
    @include('layouts.sidebar')
    @include('layouts.topbar')
    
    <main class="ml-64 pt-20 p-6">
        <div class="grid grid-cols-1  gap-6">
            <!-- Profile Details Form -->
            <div class="rounded-xl shadow-sm border border-slate-200 overflow-hidden bg-white">
                <!-- Header -->
                <div class="p-6 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-primary to-primary-hover flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900">Profile Details</h3>
                            <p class="text-sm text-slate-500">Update your personal information</p>
                        </div>
                    </div>
                </div>
                
                <!-- Form Content -->
                <div class="p-6">
                    @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf @method('PUT')
                        <input type="hidden" name="name" id="full_name">
                        
                        <!-- First/Last Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">First Name *</label>
                                <input type="text" name="firstname" value="{{ old('firstname', explode(' ', Auth::user()->name, 2)[0] ?? '') }}" 
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Last Name</label>
                                <input type="text" name="lastname" value="{{ old('lastname', explode(' ', Auth::user()->name, 2)[1] ?? '') }}" 
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            </div>
                        </div>

                        <!-- Username & Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                                <input type="text" value="{{ old('username', explode('@', Auth::user()->email)[0]) }}" readonly 
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg bg-slate-50 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required>
                            </div>
                        </div>

                        <!-- Phone & Birth Date -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" 
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Birth Date</label>
                                <input type="date" name="birth_date" value="{{ old('birth_date') }}" 
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            </div>
                        </div>

                        <!-- $portfolio (#0257b3 file button) -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Admin Icon</label>
                            <div class="flex items-start gap-4">
                                <div class="w-20 h-20 rounded-xl overflow-hidden border-2 border-dashed border-slate-300 flex-shrink-0 bg-slate-50">
                                    @if(Auth::user()->avatar)
                                    <img src="{{ asset('uploads/avatars/' . Auth::user()->avatar) }}" alt="Logo" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary to-primary-hover flex items-center justify-center text-white font-bold text-xs">
                                        Logo
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="avatar" accept="image/*" class="file-input block w-full text-sm text-slate-500 border border-slate-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:border-transparent bg-white cursor-pointer">
                                    <p class="text-xs text-slate-500 mt-1">PNG or JPG up to 2MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Buttons -->
                        <div class="flex gap-4 pt-4">
                            <button type="submit" class="flex-1 bg-primary hover:bg-primary-hover text-white py-3 px-6 rounded-xl font-semibold shadow-sm hover:shadow-md transition-all">
                                <svg class="w-5 h-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Profile
                            </button>
                            <a href="{{ route('dashboard') }}" class="flex-1 text-center py-3 px-6 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-semibold transition-all">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

 
        </div>
    </main>

    <script>
        // Name sync
        ['firstname', 'lastname'].forEach(name => {
            const input = document.querySelector(`[name="${name}"]`);
            input?.addEventListener('input', () => {
                const first = document.querySelector('[name="firstname"]').value.trim();
                const last = document.querySelector('[name="lastname"]').value.trim();
                document.getElementById('full_name').value = first + (last ? ' ' + last : '');
            });
        });

        // Password match validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', e => {
                const pass = form.querySelector('[name="password"]');
                const confirm = form.querySelector('[name="password_confirmation"]');
                if (pass?.value && confirm?.value && pass.value !== confirm.value) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    confirm.focus();
                    return false;
                }
            });
        });
    </script>
</body>
</html>
