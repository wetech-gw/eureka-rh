<script>
(function() {
    const root = document.documentElement;

    const icons = {
        sun: '<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>',
        moon: '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>'
    };

    function sync(toggle) {
        const isDark = root.getAttribute('data-theme') === 'dark';
        const icon = toggle.querySelector('.theme-icon');
        const label = toggle.querySelector('.theme-label');
        if (icon) icon.innerHTML = isDark ? icons.sun : icons.moon;
        if (label) label.textContent = isDark ? 'Claro' : 'Escuro';
    }

    function setTheme(theme) {
        root.setAttribute('data-theme', theme);
        localStorage.setItem('eureka-theme', theme);
        document.querySelectorAll('.theme-toggle').forEach(sync);
    }

    document.querySelectorAll('.theme-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            setTheme(root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        });
        sync(toggle);
    });
})();
</script>
<script src="{{ asset('js/mobile.js') }}"></script>
