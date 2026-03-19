<!-- Topbar -->
<header
  class="fixed top-0 right-0 left-0 md:left-64 h-16 bg-[#0f172a] border-b border-slate-700 flex items-center justify-between px-6 z-40">
  <div class="md:hidden">
    <button id="mobileMenuBtn" class="text-white p-3">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </div>
  <div class="hidden md:flex">
    @php $role = Auth::user()->role ?? 'admin'; @endphp
    <h2 class="text-xl font-semibold text-white">{{ $role === 'super_admin' ? ' Admin Dashboard' : 'Admin Dashboard' }}
    </h2>
  </div>
  <!-- Admin Mobile Sidebar Script -->
  @include('layouts.admin-script')
  <div class="flex items-center gap-4">
    <!-- Dark Mode Toggle Button -->
    <button id="darkModeToggle" class="text-slate-300 hover:text-white transition p-2 rounded-lg hover:bg-slate-700">
      <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
      </svg>
      <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
      </svg>
    </button>
    <button id="notificationBtn" class="relative text-slate-300 hover:text-white transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
      </svg>
      <span id="notificationBadge"
        class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center hidden">0</span>
    </button>
    <div id="notificationDropdown"
      class="hidden absolute right-20 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 z-50 max-h-96 overflow-y-auto">
      <div class="px-4 py-2 border-b border-slate-200 flex items-center justify-between">
        <p class="text-sm font-semibold text-slate-800">Notifications</p>
        <button id="markAllReadBtn" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Mark all read</button>
      </div>
      <div id="notificationList">
        <div class="px-4 py-4 text-slate-500 text-sm text-center">No notifications</div>
      </div>
    </div>
    <div class="relative">
      <button id="userMenuBtn" class="flex items-center gap-3 text-slate-300 hover:text-white transition">
        <div class="w-10 h-10 rounded-full overflow-hidden">
          @if(Auth::user()->avatar)
            <img src="{{ asset('uploads/avatars/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
              class="w-full h-full object-cover">
          @else
            <div
              class="w-full h-full bg-gradient-to-r from-[#0257b3] to-[#0d9488] flex items-center justify-center text-white font-bold text-sm">
              {{ substr(Auth::user()->name, 0, 2) }}
            </div>
          @endif
        </div>
      </button>
      <div id="userDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-2 z-50">
        <div class="px-4 py-2 border-b border-slate-200 mb-2">
          <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
          <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
          <p class="text-xs text-slate-500">{{ ucfirst(Auth::user()->role ?? 'admin') }}</p>
        </div>

        <a href="{{ route('admin.profile.edit') }}"
          class="flex items-center gap-2 px-4 py-2 text-slate-700 hover:bg-slate-100">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543 .94-3.31-.826-2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          Edit Profile
        </a>

        <a href="/admin/change-password" class="flex items-center gap-2 px-4 py-2 text-slate-700 hover:bg-slate-100">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
          Change Password
        </a>

        <hr class="my-2 border-slate-200">
        <form method="POST" action="{{ route('logout') }}" class="w-full">@csrf
          <button type="submit"
            class="flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 w-full text-left rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</header>

<script>
  document.getElementById('userMenuBtn')?.addEventListener('click', function (e) {
    e.stopPropagation();
    document.getElementById('userDropdown').classList.toggle('hidden');
    document.getElementById('notificationDropdown')?.classList.add('hidden');
  });
  document.getElementById('notificationBtn')?.addEventListener('click', function (e) {
    e.stopPropagation();
    loadNotifications();
    document.getElementById('notificationDropdown').classList.toggle('hidden');
    document.getElementById('userDropdown').classList.add('hidden');
  });

  function loadNotifications() {
    fetch('/notifications')
      .then(res => res.json())
      .then(data => {
        const badge = document.getElementById('notificationBadge');
        const list = document.getElementById('notificationList');

        badge.textContent = data.unread_count;
        badge.style.display = data.unread_count > 0 ? 'flex' : 'none';

        if (data.notifications.length) {
          list.innerHTML = data.notifications.map(n => `
          <div class="p-3 border-b cursor-pointer hover:bg-gray-50 notification-item" data-id="${n.id}">
            <div class="flex">
              <div class="flex-1">
                <div class="font-medium text-sm">${n.title}</div>
                <div class="text-xs text-gray-500">${n.message}</div>
                <div class="text-xs text-gray-400">${n.time}</div>
              </div>
            </div>
          </div>
        `).join('');
        } else {
          list.innerHTML = '<div class="p-4 text-center text-gray-500 text-sm">No notifications</div>';
        }
      });
  }

  document.addEventListener('click', e => {
    if (e.target.closest('.notification-item')) {
      const id = e.target.closest('.notification-item').dataset.id;
      fetch(`/notifications/${id}/read`, { method: 'PATCH' })
        .then(() => loadNotifications());
    }
  });
  document.addEventListener('click', function (event) {
    if (!document.getElementById('userMenuBtn').contains(event.target) && !document.getElementById('userDropdown').contains(event.target)) {
      document.getElementById('userDropdown').classList.add('hidden');
    }
    if (!document.getElementById('notificationBtn').contains(event.target) && !document.getElementById('notificationDropdown').contains(event.target)) {
      document.getElementById('notificationDropdown').classList.add('hidden');
    }
  });

  // Dark Mode Toggle
  (function () {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const sunIcon = document.getElementById('sunIcon');
    const moonIcon = document.getElementById('moonIcon');
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
      document.documentElement.classList.add('dark');
      sunIcon?.classList.remove('hidden');
      moonIcon?.classList.add('hidden');
    } else {
      document.documentElement.classList.remove('dark');
      sunIcon?.classList.add('hidden');
      moonIcon?.classList.remove('hidden');
    }
    darkModeToggle?.addEventListener('click', function () {
      const isDark = document.documentElement.classList.toggle('dark');
      localStorage.setItem('darkMode', isDark);
      if (isDark) {
        sunIcon?.classList.remove('hidden');
        moonIcon?.classList.add('hidden');
      } else {
        sunIcon?.classList.add('hidden');
        moonIcon?.classList.remove('hidden');
      }
    });
  })();
</script>