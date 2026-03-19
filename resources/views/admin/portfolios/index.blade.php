<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolios - Regret Consultancy</title>
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
@if(Session::has('success'))
    <div id="successPopup" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl p-8 flex flex-col items-center">
            <div class="w-20 h-20 rounded-full bg-[#22c55e] flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-[#1e293b] mb-2">Success!</h3>
            <p class="text-slate-600 text-center">{{ Session::get('success') }}</p>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const popup = document.getElementById('successPopup');
            if (popup) popup.remove();
        }, 1500);
    </script>
    @endif
    
    @include('layouts.sidebar')
    @include('layouts.topbar')
    
    <main class="pt-16 p-4 md:p-6 md:ml-64 mt-10">
        <div class="rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold text-[#1e293b]">Portfolios</h3>
                    <p class="text-sm text-slate-500 mt-1">Manage your portfolios</p>
                </div>
                <a href="{{ route('portfolios.create') }}" class="btn-primary px-4 py-2 rounded-lg text-white inline-flex items-center gap-2 w-full sm:w-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Portfolio
                </a>
            </div>
            
            <div class="p-6 pb-0">
                <div class="relative w-full sm:w-64">
                    <input type="text" id="searchInput" value="{{ $search }}" placeholder="Search..." class="pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0257b3] w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            
            <div id="tableContent">
                <div class="overflow-x-auto w-full mt-4">
                    <table class="w-full">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Image</th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                    <a href="javascript:void(0)" onclick="sortBy('title')" class="flex items-center gap-1 hover:text-[#0257b3]">
                                        Title
                                    </a>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                    <a href="javascript:void(0)" onclick="sortBy('description')" class="flex items-center gap-1 hover:text-[#0257b3]">
                                        Description
                                    </a>
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">
                                    <a href="javascript:void(0)" onclick="sortBy('status')" class="flex items-center gap-1 hover:text-[#0257b3]">
                                        Status
                                    </a>
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200" id="tableBody">
                            @forelse($portfolios as $portfolio)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    @if($portfolio->image)
                                    <img src="{{ asset('uploads/portfolios/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                    <span class="text-slate-400">No Image</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-800 font-medium">{{ $portfolio->title }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700 max-w-xs truncate">{{ Str::limit($portfolio->description ?? '', 80) }}</td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $portfolio->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($portfolio->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('portfolios.edit', $portfolio) }}" class="text-[#0257b3] hover:text-[#0d9488] font-medium text-sm mr-3">Edit</a>
                                    <button type="button" onclick="deletePortfolio({{ $portfolio->id }})" class="text-[#ef4444] hover:text-[#dc2626] font-medium text-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                    No portfolios found. <a href="{{ route('portfolios.create') }}" class="text-[#0257b3]">Add one now</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
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
                        {{ $portfolios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentSearch = '{{ $search }}';
        let currentSort = '{{ $sortColumn }}';
        let currentDirection = '{{ $sortDirection }}';
        let currentPerPage = '{{ $perPage }}';
        let currentPage = 1;
        
        let searchTimeout;
        
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                currentSearch = document.getElementById('searchInput').value;
                currentPage = 1;
                loadPortfolios();
            }, 500); // Slower debounce
        });
        
        function sortBy(column) {
            if (currentSort === column) {
                currentDirection = currentDirection === 'asc' ? 'desc' : 'asc';
            } else {
                currentSort = column;
                currentDirection = 'asc';
            }
            currentPage = 1;
            loadPortfolios();
        }
        
        function changePageLimit(limit) {
            currentPerPage = limit;
            currentPage = 1;
            loadPortfolios();
        }
        
        function loadPortfolios() {
            let url = '{{ route("portfolios.index") }}?' + new URLSearchParams({
                search: currentSearch,
                sort: currentSort,
                direction: currentDirection,
                per_page: currentPerPage,
                page: currentPage
            });
            
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    const newTableBody = doc.getElementById('tableBody');
                    if (newTableBody) {
                        document.getElementById('tableBody').innerHTML = newTableBody.innerHTML;
                    }
                    
                    const newPagination = doc.getElementById('paginationLinks');
                    if (newPagination) {
                        document.getElementById('paginationLinks').innerHTML = newPagination.innerHTML;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        
        function deletePortfolio(portfolioId) {
            const popup = document.createElement('div');
            popup.id = 'deletePopup';
            popup.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50';
            popup.innerHTML = `
                <div class="bg-white rounded-2xl shadow-2xl p-8 flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-red-500 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Delete Portfolio</h3>
                    <p class="text-gray-600 text-center mb-6">Are you sure? This action cannot be undone.</p>
                    <div class="flex gap-4">
                        <button onclick="this.closest('#deletePopup').remove()" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                        <button onclick="confirmDelete(${portfolioId})" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Delete</button>
                    </div>
                </div>
            `;
            document.body.appendChild(popup);
        }
        
        async function confirmDelete(portfolioId) {
            document.getElementById('deletePopup').remove();
            
            try {
                const response = await fetch(`/portfolios/${portfolioId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (!response.ok) throw new Error('Failed to delete');
                
                const data = await response.json();
                loadPortfolios();
                showSuccessPopup(data.message || 'Portfolio deleted successfully!');
                
            } catch (error) {
                console.error('Error:', error);
                alert('Delete failed. Try again.');
            }
        }
        
        function showSuccessPopup(message) {
            const popup = document.createElement('div');
            popup.innerHTML = `
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 flex flex-col items-center">
                        <div class="w-20 h-20 rounded-full bg-green-500 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Success!</h3>
                        <p class="text-gray-600 text-center">${message}</p>
                    </div>
                </div>
            `;
            document.body.appendChild(popup);
            setTimeout(() => popup.remove(), 1000);
        }
    </script>
</body>
</html>

