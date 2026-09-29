/* Navotas Hospital System — shared behaviour (no dependencies) */

// ---- Side menu (desktop: collapse, mobile: drawer) ----
function isMobile() { return window.matchMedia('(max-width: 960px)').matches; }

function toggleSideMenu() {
    var body = document.body;
    if (isMobile()) {
        body.classList.toggle('menu-open');
    } else {
        body.classList.toggle('menu-closed');
    }
}

// ---- User dropdown ----
function toggleDropdown() {
    var dropdown = document.getElementById('userDropdown');
    if (dropdown) dropdown.classList.toggle('active');
}

window.addEventListener('click', function (event) {
    var dropdown = document.getElementById('userDropdown');
    if (dropdown && dropdown.classList.contains('active') && !event.target.closest('.profile-btn')) {
        dropdown.classList.remove('active');
    }
});

// ---- Modal helpers ----
function openModal(id) {
    var el = document.getElementById(id);
    if (el) el.classList.add('open');
}
function closeModal(id) {
    var el = document.getElementById(id);
    if (el) el.classList.remove('open');
}
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal.open').forEach(function (m) { m.classList.remove('open'); });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-filter-scope]').forEach(function (scope) {
        var input  = scope.querySelector('[data-filter-input]');
        var chips  = scope.querySelectorAll('[data-filter-chip]');
        var select = scope.querySelector('[data-filter-select]');
        var count  = scope.querySelector('[data-filter-count]');
        var empty  = scope.querySelector('[data-filter-empty]');
        var items  = scope.querySelectorAll('[data-filter-item]');
        var group  = 'all';

        function apply() {
            var q = input ? input.value.trim().toLowerCase() : '';
            var status = select ? select.value : 'all';
            var shown = 0;

            items.forEach(function (item) {
                var okText   = !q || (item.dataset.search || '').toLowerCase().indexOf(q) !== -1;
                var okGroup  = group === 'all' || item.dataset.group === group;
                var okStatus = status === 'all' || item.dataset.status === status;
                var visible  = okText && okGroup && okStatus;
                item.style.display = visible ? '' : 'none';
                if (visible) shown++;
            });

            if (count) count.textContent = shown + (shown === 1 ? ' result' : ' results');
            if (empty) empty.classList.toggle('show', shown === 0);
        }

        if (input)  input.addEventListener('input', apply);
        if (select) select.addEventListener('change', apply);
        chips.forEach(function (chip) {
            chip.addEventListener('click', function () {
                chips.forEach(function (c) { c.classList.remove('active'); });
                chip.classList.add('active');
                group = chip.dataset.filterChip;
                apply();
            });
        });

        apply();
    });

    // Header search box → jump to the page's own filter if there is one
    var globalSearch = document.getElementById('globalSearch');
    var localSearch  = document.querySelector('[data-filter-input]');
    if (globalSearch && localSearch) {
        globalSearch.addEventListener('input', function () {
            localSearch.value = globalSearch.value;
            localSearch.dispatchEvent(new Event('input'));
        });
    }

    // Animate progress bars from 0
    document.querySelectorAll('.progress > span[data-w]').forEach(function (bar) {
        requestAnimationFrame(function () { bar.style.width = bar.dataset.w + '%'; });
    });
});
