<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Career - Regret Consultancy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #0257b3;
            --primary-hover: #0d9488;
            --secondary: #0f172a;
        }
        body { background-color: #f1f5f9; }
        .sidebar { background-color: var(--secondary); }
        .topbar { background-color: var(--secondary); }
        .btn-primary { background-color: var(--primary); color: white; }
        .btn-primary:hover { background-color: var(--primary-hover); }
    </style>
</head>
<body class="font-sans">
    <!-- Include Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Include Topbar -->
    @include('layouts.topbar')
    
    <!-- Main Content -->
    <main class="pt-16 p-4 md:p-6 md:ml-64 mt-10">
        <div class="max-w-3xl mx-auto">
            <div class="card rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <!-- Header -->
                <div class="p-6 border-b border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h3 class="text-xl font-bold text-[#1e293b]">Add New Career</h3>
                            <p class="text-sm text-slate-500 mt-1">Create a new career opportunity</p>
                        </div>
                        <a href="{{ route('careers.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 inline-flex items-center gap-2 w-full sm:w-auto justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back
                        </a>
                    </div>
                </div>
                
                <!-- Form -->
                <form method="POST" action="{{ route('careers.store') }}" enctype="multipart/form-data" class="p-6">
                    @csrf
                    
                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Title <span class="text-red-500">*</span></label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title') }}"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] focus:border-transparent @error('title') border-red-500 @enderror"
                               placeholder="Enter career title">
                        @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Details -->
                    <div class="mb-6">
                        <label for="details" class="block text-sm font-medium text-slate-700 mb-2">Details</label>
                        <textarea name="details" 
                                  id="details" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] focus:border-transparent @error('details') border-red-500 @enderror"
                                  placeholder="Enter career details">{{ old('details') }}</textarea>
                        @error('details')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Location -->
                    <div class="mb-6">
                        <label for="location" class="block text-sm font-medium text-slate-700 mb-2">Location</label>
                        <input type="text" 
                               name="location" 
                               id="location" 
                               value="{{ old('location') }}"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] focus:border-transparent @error('location') border-red-500 @enderror"
                               placeholder="Enter location (e.g., Remote, New York)">
                        @error('location')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Type -->
                    <div class="mb-6">
                        <label for="type" class="block text-sm font-medium text-slate-700 mb-2">Type <span class="text-red-500">*</span></label>
                        <select name="type" 
                                id="type"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] focus:border-transparent @error('type') border-red-500 @enderror">
                            <option value="" disabled selected>Select type</option>
                            <option value="full_time" {{ old('type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part_time" {{ old('type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                            <option value="remote" {{ old('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="hybrid" {{ old('type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                        @error('type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Image -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-slate-700 mb-2">Image</label>
                        <input type="file" 
                               name="image" 
                               id="image"
                               accept="image/*"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] focus:border-transparent @error('image') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-slate-500">Allowed: jpeg, png, jpg, gif, svg. Max size: 2MB</p>
                        @error('image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="status" 
                                id="status"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-start gap-4">
                        <button type="submit" class="btn-primary px-6 py-2 rounded-lg">Create Career</button>
                                                <a href="{{ route('careers.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</a>

                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

