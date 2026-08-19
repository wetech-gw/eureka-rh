/* =========================================================
   EUREKA RH — Mobile Sidebar Toggle
   ========================================================= */
(function () {
    function initMobileMenu() {
        var toggle = document.querySelector('.mobile-menu-toggle');
        var overlay = document.querySelector('.sidebar-overlay');
        if (!toggle) return;

        function openSidebar() {
            document.body.classList.add('sidebar-open');
        }
        function closeSidebar() {
            document.body.classList.remove('sidebar-open');
        }

        toggle.addEventListener('click', function () {
            document.body.classList.contains('sidebar-open') ? closeSidebar() : openSidebar();
        });

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeSidebar();
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 767) closeSidebar();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileMenu);
    } else {
        initMobileMenu();
    }
})();
