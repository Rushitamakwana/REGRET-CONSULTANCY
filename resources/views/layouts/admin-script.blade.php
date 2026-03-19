<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('main') || document.body;
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeBtn = document.getElementById('closeBtn');

        // Open sidebar
        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            mainContent.classList.add('-ml-64');
            document.body.classList.add('overflow-hidden');
        }

        // Close sidebar
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            mainContent.classList.remove('-ml-64');
            document.body.classList.remove('overflow-hidden');
        }

        // Mobile menu button
        mobileMenuBtn?.addEventListener('click', openSidebar);

        // Close button (if exists)
        closeBtn?.addEventListener('click', closeSidebar);

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!sidebar.contains(e.target) && !mobileMenuBtn?.contains(e.target)) {
                closeSidebar();
            }
        });

        // Close on escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeSidebar();
            }
        });
    });
</script>