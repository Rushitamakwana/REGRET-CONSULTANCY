<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers - Regret Consultancy</title>
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
    <!-- Success Popup Message -->
    @if(Session::has('success'))
    <div id="successPopup" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl p-8 flex flex-col items-center transform scale-100">
            <!-- Green Tick Circle -->
            <div class="w-20 h-20 rounded-full bg-[#22c55e] flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <!-- Success Message -->
            <h3 class="text-2xl font-bold text-[#1e293b] mb-2">Success!</h3>
            <p class="text-slate-600 text-center">{{ Session::get('success') }}</p>
        </div>
    </div>
    
    <script>
        setTimeout(function() {
            var popup = document.getElementById('successPopup');
            if (popup) {
                popup.style.opacity = '0';
                popup.style.transition = 'opacity 0.5s ease-out';
                setTimeout(function() {
                    popup.remove();
                }, 500);
            }
        }, 2000);
        
        document.getElementById('successPopup')?.addEventListener('click', function() {
            this.remove();
        });
    </script>
    @endif
    
    <!-- Include Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Include Topbar -->
    @include('layouts.topbar')
    
    <!-- Main Content -->
    <main class="pt-16 p-4 md:p-6 md:ml-64 mt-10">
        <div class="card rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <!-- Header with Title and Button -->
            <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold text-[#1e293b]">Careers</h3>
                    <p class="text-sm text-slate-500 mt-1">Manage career opportunities here</p>
                </div>
                <a href="{{ route('careers.create') }}" class="btn-primary px-4 py-2 rounded-lg text-white inline-flex items-center gap-2 w-full sm:w-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Career
                </a>
            </div>
            
            <!-- Search Box -->
            <div class="p-6 pb-0">
                <div class="relative w-full sm:w-64">
                    <input type="text" 
                           id="searchInput" 
                           value="{{ $search }}"
                           placeholder="Search careers..." 
                           class="pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] focus:border-transparent w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            
            <!-- Table Content -->
            <div id="tableContent">
                <div class="overflow-x-auto w-full mt-5">
                    <table class="w-full">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Image</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                    <a href="javascript:void(0)" onclick="sortBy('title')" class="flex items-center gap-1 hover:text-[#0257b3]">
                                        Title
                                        @if($sortColumn === 'title')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline text-[#0257b3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                    <a href="javascript:void(0)" onclick="sortBy('location')" class="flex items-center gap-1 hover:text-[#0257b3]">
                                        Location
                                        @if($sortColumn === 'location')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline text-[#0257b3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                    <a href="javascript:void(0)" onclick="sortBy('type')" class="flex items-center gap-1 hover:text-[#0257b3]">
                                        Type
                                        @if($sortColumn === 'type')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline text-[#0257b3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                    <a href="javascript:void(0)" onclick="sortBy('status')" class="flex items-center gap-1 hover:text-[#0257b3]">
                                        Status
                                        @if($sortColumn === 'status')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline text-[#0257b3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200" id="tableBody">
                            @forelse($careers as $index => $career)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    @if($career->image)
                                    <img src="{{ asset('uploads/careers/' . $career->image) }}" alt="{{ $career->title }}" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                    <span class="text-slate-400">No Image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-800 font-medium">{{ $career->title }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-600">{{ $career->location ?: 'Not specified' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        {{ ucwords(str_replace('_', ' ', $career->type)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $career->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($career->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('careers.edit', $career->id) }}" class="text-[#0257b3] hover:text-[#0d9488] font-medium text-sm mr-3">Edit</a>
                                    <button type="button" onclick="deleteCareer({{ $career->id }})" class="text-[#ef4444] hover:text-[#dc2626] font-medium text-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                    No careers found. <a href="{{ route('careers.create') }}" class="text-[#0257b3]">Add one now</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination with Page Limit -->
                <div class="px-4 md:px-6 py-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-500">Show</span>
                        <select id="pageLimit" onchange="changePageLimit(this.value)" class="border border-slate-300 rounded-lg px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-[#0257b3]">
                            <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <span class="text-sm text-slate-500">entries</span>
                    </div>
                    
                    <div class="flex items-center gap-1" id="paginationLinks">
                        {{ $careers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Current state
        let currentSearch = '{{ $search }}';
        let currentSort = '{{ $sortColumn }}';
        let currentDirection = '{{ $sortDirection }}';
        let currentPerPage = '{{ $perPage }}';
        
        // Debounce search
        let searchTimeout;
        
        // Search input handler
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                currentSearch = document.getElementById('searchInput').value;
                loadCareers(1);
            }, 300);
        });
        
        // Sort function
        function sortBy(column) {
            if (currentSort === column) {
                currentDirection = currentDirection === 'asc' ? 'desc' : 'asc';
            } else {
                currentSort = column;
                currentDirection = 'asc';
            }
            loadCareers(1);
        }
        
        // Change page limit
        function changePageLimit(limit) {
            currentPerPage = limit;
            loadCareers(1);
        }
        
        // Load careers via AJAX
        function loadCareers(page) {
            let url = '{{ route("careers.index") }}?search=' + encodeURIComponent(currentSearch) + 
                      '&sort=' + currentSort + 
                      '&direction=' + currentDirection + 
                      '&per_page=' + currentPerPage + 
                      '&page=' + page;
            
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    
                    let newTableBody = doc.getElementById('tableBody').innerHTML;
                    document.getElementById('tableBody').innerHTML = newTableBody;
                    
                    let newPagination = doc.getElementById('paginationLinks').innerHTML;
                    document.getElementById('paginationLinks').innerHTML = newPagination;
                })
                .catch(error => console.error('Error:', error));
        }
        
        // Delete career with AJAX and popup confirmation
        function deleteCareer(careerId) {
            // Show delete confirmation popup
            const popup = document.createElement('div');
            popup.id = 'deletePopup';
            popup.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50';
            popup.innerHTML = `
                <div class="bg-white rounded-2xl shadow-2xl p-8 flex flex-col items-center transform scale-100">
                    <div class="w-20 h-20 rounded-full bg-[#ef4444] flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e293b] mb-2">Delete Career</h3>
                    <p class="text-slate-600 text-center mb-6">Are you sure you want to delete this career opportunity?</p>
                    <div class="flex gap-4">
                        <button onclick="this.closest('#deletePopup').remove()" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                        <button onclick="confirmDelete(${careerId})" class="px-6 py-2 bg-[#ef4444] text-white rounded-lg hover:bg-[#dc2626]">Delete</button>
                    </div>
                </div>
            `;
            document.body.appendChild(popup);
            return false;
        }
        
        // Confirm delete and execute
        async function confirmDelete(careerId) {
            const popup = document.getElementById('deletePopup');
            if (popup) popup.remove();
            
            try {
                const response = await fetch(`/careers/${careerId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (!response.ok) throw new Error('Network response was not ok');
                
                const data = await response.json();
                
                // Reload table to show updated data
                loadCareers(1);
                
                // Show success popup
                showSuccessPopup(data.message || 'Career deleted successfully!');
                
            } catch (error) {
                console.error('Error deleting career:', error);
                alert('Failed to delete career. Please try again.');
            }
            
            return false;
        }
        
        // Show success popup (auto-remove)
        function showSuccessPopup(message) {
            const popup = document.createElement('div');
            popup.id = 'successPopup';
            popup.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50';
            popup.innerHTML = `
                <div class="bg-white rounded-2xl shadow-2xl p-8 flex flex-col items-center transform scale-100">
                    <div class="w-20 h-20 rounded-full bg-[#22c55e] flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1e293b] mb-2">Success!</h3>
                    <p class="text-slate-600 text-center">${message}</p>
                </div>
            `;
            document.body.appendChild(popup);
            
            // Auto remove after 2 seconds
            setTimeout(function() {
                popup.style.opacity = '0';
                popup.style.transition = 'opacity 0.5s ease-out';
                setTimeout(function() {
                    popup.remove();
                }, 500);
            }, 2000);
        }
    </script>
</body>
</html>
