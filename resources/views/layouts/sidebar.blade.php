<!-- Sidebar -->
<aside id="sidebar"
    class="sidebar fixed left-0 top-0 h-full w-64 md:w-64 text-white flex flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
    <!-- Logo -->
    <div class="p-6 border-b border-white/10 flex items-center justify-between">
        <div>
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-10 w-auto">
            <p class="text-xs text-gray-400 mt-1">Admin Panel</p>
        </div>
        <button id="closeBtn" class="md:hidden text-white hover:text-gray-300 p-2 rounded-lg hover:bg-white/10">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 overflow-y-auto">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#0257b3]/20 {{ request()->routeIs('dashboard') ? 'bg-[#0257b3]' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>

            <!-- Services Link -->
            <li>
                <a href="{{ route('services.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#0257b3]/20 {{ request()->routeIs('services.*') ? 'bg-[#0257b3]' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Services
                </a>
            </li>

            <!-- Portfolios Link -->
            <li>
                <a href="{{ route('portfolios.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#0257b3]/20 {{ request()->routeIs('portfolios.*') ? 'bg-[#0257b3]' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                    </svg>
                    Portfolios
                </a>
            </li>

            <!-- Careers Link -->
            <li>
                <a href="{{ route('careers.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#0257b3]/20 {{ request()->routeIs('careers.*') ? 'bg-[#0257b3]' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 8.25c0-2.48-2.01-4.5-4.5-4.5-.66 0-1.288.1-1.87.29l-.875-1.75a2.25 2.25 0 00-3.3 0l-.875 1.75A4.5 4.5 0 007.5 3.75c-2.49 0-4.5 2.02-4.5 4.5 0 3.35 2.04 6.23 4.91 7.52.26.12.58.18.9.18.32 0 .64-.06.9-.18 1.68-1.45 3.43-2.46 5.09-2.99V18a2.25 2.25 0 004.5 0v-2.25c1.66.53 3.41 1.54 5.09 2.99a2.25 2.25 0 001.8 0C22.96 16.98 25 14.1 25 10.75s-2.04-6.23-4.91-7.52z" />
                    </svg>
                    Careers
                </a>
            </li>

            <!-- Contact Inquiries Link -->
            <li>
                <a href="{{ route('contacts.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#0257b3]/20 {{ request()->routeIs('contacts.*') ? 'bg-[#0257b3]' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Contact Inquiries
                </a>
            </li>

            <!-- Job Applications Link - NEW -->
            <li>
                <a href="{{ route('applications.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#0257b3]/20 {{ request()->routeIs('applications.*') ? 'bg-[#0257b3]' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6a1 1 0 102 0v-6a1 1 0 00-2 0zm4 0v6a1 1 0 102 0v-6a1 1 0 00-2 0z" />
                    </svg>
                    Job Applications
                </a>
            </li>
        </ul>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-white/10">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 text-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>