<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details - {{ $application->name }} - Regret Consultancy Admin</title>
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
    </style>
</head>
<body class="font-sans">
    @include('layouts.sidebar')
    @include('layouts.topbar')
    
    <main class="ml-64 pt-16 p-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-8">
                <div class="flex flex-col md:flex-row md:items-start md:gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-r from-[#0257b3] to-[#0d9488] rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 mt-4 md:mt-0">
                        <h1 class="text-3xl font-bold text-slate-900">{{ $application->name }}</h1>
                        <p class="text-slate-500 mt-1">Job Application #{{ $application->id }}</p>
                        <div class="flex flex-wrap gap-4 mt-4 text-sm">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-medium">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                {{ ucfirst($application->position) }}
                            </span>
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($application->status === 'read' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }} font-medium">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-4 md:mt-0">
                        <a href="{{ route('applications.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-slate-200 hover:bg-slate-300 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to List
                        </a>
                        @if($application->status !== 'read')
                        <form action="{{ route('applications.mark-read', $application->id) }}" method="POST" class="inline">
                            @csrf @method('POST')
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-[#0257b3] hover:bg-[#0d9488] rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1 3a9 9 0 01-9-9 9 9 0 019-9h1.586a1 1 0 01.707.293l3.828 3.828a1 1 0 010 1.414l-6.586 6.586a1 1 0 01-1.414 0l-3.828-3.828a1 1 0 01-.293-.707V9a1 1 0 012 0v1.5z" />
                                </svg>
                                Mark as Read
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Contact Info -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#0257b3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.27 7.27c.396.397.958.58 1.523.58.565 0 1.127-.183 1.523-.58L21 8M13 10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v6h6z" />
                        </svg>
                        Contact Information
                    </h2>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-slate-500 block mb-1">Email</label>
                            <p class="text-lg font-semibold text-slate-900">{{ $application->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-500 block mb-1">Phone</label>
                            <p class="text-lg font-semibold text-slate-900">{{ $application->phone }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-500 block mb-1">Position Applied</label>
                            <p class="text-lg font-semibold text-slate-900">{{ $application->position }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-500 block mb-1">IP Address</label>
                            <p class="text-lg font-semibold text-slate-900">{{ $application->ip_address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Resume & Timestamps -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#0257b3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Resume & Timeline
                    </h2>
                    <div class="space-y-6">
                        @if($application->resume)
                        <div>
                            <label class="text-sm font-medium text-slate-500 block mb-3">Resume</label>
                            <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl border-2 border-dashed border-slate-200">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <div>
                                    <a href="{{ asset('uploads/applications/' . $application->resume) }}" target="_blank" 
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-[#0257b3] text-white font-medium text-sm rounded-lg hover:bg-[#0d9488] transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3" />
                                        </svg>
                                        Download Resume
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="p-8 text-center bg-slate-50 rounded-xl border-2 border-dashed border-slate-200">
                            <svg class="w-12 h-12 mx-auto text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-slate-500">No resume attached</p>
                        </div>
                        @endif

                        <!-- Timeline -->
                        <div>
                            <label class="text-sm font-medium text-slate-500 block mb-3">Application Timeline</label>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-lg">
                                    <div class="w-2 h-2 bg-[#0257b3] rounded-full"></div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Submitted</p>
                                        <p class="text-xs text-slate-500">{{ $application->created_at->format('M d, Y \\a\\t g:i A') }}</p>
                                    </div>
                                </div>
                                @if($application->updated_at->gt($application->created_at))
                                <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-lg">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Last Updated</p>
                                        <p class="text-xs text-slate-500">{{ $application->updated_at->format('M d, Y \\a\\t g:i A') }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Button - Bottom Right -->
            <div class="mt-8 flex justify-end">
                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this application?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl transition-all shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Application
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

