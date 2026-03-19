<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regret - Change Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #0257b3;
            --primary-hover: #0d9488;
            --secondary: #0f172a;
        }
        body { background-color: #f1f5f9; }
    </style>
</head>
<body class="font-sans">
  
    
    <main class="">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-r from-teal-500 to-orange-500 flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">Change Password</h1>
                    <p class="text-slate-600">Enter current password and new password below</p>
                </div>
                
                @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-800 text-sm">
                    {{ session('success') }}
                </div>
                @endif
                
                @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Current Password *</label>
                            <input type="password" name="current_password" required 
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">New Password *</label>
                            <input type="password" name="password" required minlength="8"
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Confirm New Password *</label>
                            <input type="password" name="password_confirmation" required minlength="8"
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all">
                        </div>
                    </div>
                    
                    <div class="flex gap-4 mt-8">
                        <button type="submit" class="flex-1 bg-[#0257b3] hover:bg-[#0c8f8e] text-white py-3 px-6 rounded-xl font-semibold shadow-sm hover:shadow-md transition-all">
                           Change Password
                        </button>
                        <a href="{{ route('dashboard') }}" class="flex-1 text-center py-3 px-6 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-semibold transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

