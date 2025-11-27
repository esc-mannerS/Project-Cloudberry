// Menu toggle + icon swap
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('menuToggle');
    const menu = document.getElementById('slideMenu');
    const icon = document.getElementById('menuIcon');

    if (!btn || !menu) return;

    function setIcon(open) {
        if (!icon || !icon.dataset) return;
        icon.src = open ? (icon.dataset.openSrc || icon.src) : (icon.dataset.closedSrc || icon.src);
    }

    btn.addEventListener('click', function (ev) {
        ev.preventDefault();
        const isOpen = menu.classList.toggle('open');
        btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        setIcon(isOpen);
    });

    // Close when clicking outside
    document.addEventListener('click', function (ev) {
        if (!menu.classList.contains('open')) return;
        const target = ev.target;
        if (!btn.contains(target) && !menu.contains(target)) {
            menu.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            setIcon(false);
        }
    });

    // Close with Escape
    document.addEventListener('keydown', function (ev) {
        if (ev.key === 'Escape' && menu.classList.contains('open')) {
            menu.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            setIcon(false);
            btn.focus();
        }
    });
});