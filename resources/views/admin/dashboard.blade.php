<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

    <style>
        :root {
--primary: #0276db;
--primary-hover: #0257b3;
            --secondary: #0f172a;
        }

        body {
            background-color: #f1f5f9;
        }

        .sidebar {
            background-color: var(--secondary);
        }

        .topbar {
            background-color: var(--secondary);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }
    </style>

<body class="font-sans">
      @if(Session::has('success') || Session::has('login_success'))
    <div id="successPopup" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl p-8 flex flex-col items-center transform scale-100">
            <div class="w-20 h-20 rounded-full bg-[#22c55e] flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-[#1e293b] mb-2">Success!</h3>
            <p class="text-slate-600 text-center">{{ Session::get('success') ?: Session::get('login_success') }}</p>
        </div>
    </div>
    <script>
        setTimeout(function() { 
            var popup = document.getElementById('successPopup');
            if (popup) { popup.style.opacity = '0'; popup.style.transition = 'opacity 0.5s ease-out'; 
                setTimeout(function() { popup.remove(); }, 500); 
            }
        }, 3000);
        document.getElementById('successPopup')?.addEventListener('click', function() { this.remove(); });
    </script>
    @endif

    @include('layouts.sidebar')
    @include('layouts.topbar')

    <main class="p-4 md:p-6 md:ml-64 pt-20 mt-20">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-md border hover:shadow-lg transition-all">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2h10a2 2 0 012 2v2M4 4h16c.55 0 1 .45 1 1V3c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v1c0 .55.45 1 1 1z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Services</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalServices ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md border hover:shadow-lg transition-all">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Portfolio</p>
                        <p class="text-3xl font-bold text-green-600">{{ $totalPortfolios ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md border hover:shadow-lg transition-all">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.27 4.84A2 2 0 0012 11a2 2 0 00.73-.22A1.99 1.99 0 0113 10a2 2 0 00-3.5-.73L3 8zM16 6a2 2 0 100-4 2 2 0 000 4z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Contacts</p>
                        <p class="text-3xl font-bold text-purple-600">{{ $totalContacts ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md border hover:shadow-lg transition-all">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-lg">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m0 0l3-3m-3 3l3 3"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Jobs</p>
                        <p class="text-3xl font-bold text-orange-600">{{ $totalJobs ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Pie Chart - Status -->
            <div class="bg-white p-6 rounded-xl shadow-md border">
                <h3 class="text-lg font-bold mb-6">Services Status</h3>
                <canvas id="statusChart" height="300"></canvas>
            </div>

            <!-- Bar Chart - Growth -->
            <div class="bg-white p-6 rounded-xl shadow-md border">
                <h3 class="text-lg font-bold mb-6">Services Growth</h3>
                <canvas id="growthChart" height="300"></canvas>
            </div>
        </div>

        <!-- Recent Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Services -->
            <div class="lg:col-span-1 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold">Latest Services</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentServices ?? [] as $service)
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if($service->image)
                                <img class="h-10 w-10 rounded object-cover" src="{{ asset('uploads/services/' . $service->image) }}">
                                @else
                                <div class="h-10 w-10 bg-gray-200 rounded flex items-center justify-center">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ Str::limit($service->title, 20) }}</p>
                                <span class="px-2 py-1 text-xs rounded-full {{ $service->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($service->status ?? 'Inactive') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500">
                        No recent services
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Contacts -->
            <div class="lg:col-span-1 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold">Latest Contacts</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentContacts ?? [] as $contact)
                    <div class="p-4 hover:bg-gray-50">
                        <p class="text-sm font-medium text-gray-900">{{ Str::limit($contact->name ?? 'N/A', 20) }}</p>
                        <p class="text-xs text-gray-500">{{ Str::limit($contact->email ?? '', 25) }}</p>
                        <span class="text-xs text-gray-400">{{ $contact->created_at->diffForHumans() }}</span>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500">
                        No recent contacts
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Applications -->
            <div class="lg:col-span-1 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold">Latest Jobs</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentApplications ?? [] as $application)
                    <div class="p-4 hover:bg-gray-50">
                        <p class="text-sm font-medium text-gray-900">{{ Str::limit($application->name ?? 'N/A', 20) }}</p>
                        <p class="text-xs text-gray-500">{{ Str::limit($application->email ?? '', 25) }}</p>
                        <span class="text-xs text-gray-400">{{ $application->created_at->diffForHumans() }}</span>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500">
                        No recent applications
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script>
        // Pie Chart - Status
        const statusCtx = document.getElementById('statusChart');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive'],
                datasets: [{
                    data: [{{ $activeServices ?? 0 }}, {{ $inactiveServices ?? 0 }}],
                    backgroundColor: ['#10b981', '#ef4444'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Bar Chart - Growth (Sample data)
        const growthCtx = document.getElementById('growthChart');
        new Chart(growthCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Services',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: '#0ea5e9'
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</body>
</html>

