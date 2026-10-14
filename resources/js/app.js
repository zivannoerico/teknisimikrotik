/**
 * Small progressive-enhancement helpers. Nothing here is required for the
 * public pages to be readable; it only powers menus and form focus.
 */

/**
 * Wire a button that shows/hides a panel (public mobile menu, admin sidebar).
 */
function bindToggle(button, panel, { closeOnLink = true, onChange = () => {} } = {}) {
    if (!button || !panel) {
        return;
    }

    const setOpen = (open) => {
        button.setAttribute('aria-expanded', String(open));
        panel.hidden = !open;
        onChange(open);
    };

    button.addEventListener('click', () => setOpen(button.getAttribute('aria-expanded') !== 'true'));

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && button.getAttribute('aria-expanded') === 'true') {
            setOpen(false);
            button.focus();
        }
    });

    if (closeOnLink) {
        panel.addEventListener('click', (event) => {
            if (event.target.closest('a')) {
                setOpen(false);
            }
        });
    }

    window.matchMedia('(min-width: 1280px)').addEventListener('change', (event) => {
        if (event.matches) {
            setOpen(false);
        }
    });
}

bindToggle(document.getElementById('mobile-menu-button'), document.getElementById('mobile-menu'), {
    onChange: (open) => {
        document.getElementById('icon-menu')?.classList.toggle('hidden', open);
        document.getElementById('icon-close')?.classList.toggle('hidden', !open);
    },
});

// Desktop Layanan dropdown click/keyboard toggle
(() => {
    const dropdown = document.getElementById('desktop-services-dropdown');
    const trigger = document.getElementById('desktop-services-trigger');
    if (!dropdown || !trigger) return;

    trigger.addEventListener('click', (e) => {
        e.preventDefault();
        const isOpen = dropdown.classList.toggle('is-open');
        trigger.setAttribute('aria-expanded', String(isOpen));
    });

    document.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove('is-open');
            trigger.setAttribute('aria-expanded', 'false');
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            dropdown.classList.remove('is-open');
            trigger.setAttribute('aria-expanded', 'false');
        }
    });
})();

// Mobile menu Layanan collapsible submenu
(() => {
    const btn = document.getElementById('mobile-services-button');
    const submenu = document.getElementById('mobile-services-submenu');
    const chevron = document.getElementById('mobile-services-chevron');
    if (!btn || !submenu) return;

    btn.addEventListener('click', () => {
        const isOpen = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', String(!isOpen));
        submenu.hidden = isOpen;
        if (chevron) {
            chevron.classList.toggle('rotate-180', !isOpen);
        }
    });
})();

// Admin sidebar (mobile).
(() => {
    const sidebar = document.getElementById('admin-sidebar');
    const backdrop = document.getElementById('admin-backdrop');
    const button = document.getElementById('admin-sidebar-button');

    if (!sidebar || !backdrop || !button) {
        return;
    }

    const setOpen = (open) => {
        sidebar.classList.toggle('-translate-x-full', !open);
        backdrop.hidden = !open;
        button.setAttribute('aria-expanded', String(open));
    };

    button.addEventListener('click', () => setOpen(true));
    backdrop.addEventListener('click', () => setOpen(false));
    document.addEventListener('keydown', (event) => event.key === 'Escape' && setOpen(false));
})();

// Bring a form with validation errors into view so the visitor sees what to fix.
document.querySelectorAll('[data-scroll-on-error="true"]').forEach((form) => {
    form.scrollIntoView({ block: 'start' });
    form.querySelector('[aria-invalid="true"]')?.focus({ preventScroll: true });
});

// The floating WhatsApp button steps aside while a form is on screen, so it never covers fields or submit buttons.
(() => {
    const floating = document.getElementById('wa-float');
    const forms = document.querySelectorAll('[data-hide-wa-float]');

    if (!floating || forms.length === 0 || !('IntersectionObserver' in window)) {
        return;
    }

    const visible = new Set();

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            entry.isIntersecting ? visible.add(entry.target) : visible.delete(entry.target);
        });

        const hidden = visible.size > 0;
        floating.dataset.hidden = String(hidden);
        floating.tabIndex = hidden ? -1 : 0;
        floating.setAttribute('aria-hidden', String(hidden));
    });

    forms.forEach((form) => observer.observe(form));
})();

// Floating scroll-to-top button: visible after scrolling 280px, smooth scroll to top when clicked.
(() => {
    const btn = document.getElementById('scroll-to-top');
    if (!btn) {
        return;
    }

    let ticking = false;
    const updateVisibility = () => {
        const visible = window.scrollY > 280;
        btn.dataset.visible = String(visible);
        btn.tabIndex = visible ? 0 : -1;
        btn.setAttribute('aria-hidden', String(!visible));
        ticking = false;
    };

    window.addEventListener(
        'scroll',
        () => {
            if (!ticking) {
                window.requestAnimationFrame(updateVisibility);
                ticking = true;
            }
        },
        { passive: true }
    );

    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    updateVisibility();
})();

// Realtime Indonesian thousands dot separator formatting for admin price inputs
(() => {
    const formatNumberDots = (digits) => {
        if (!digits) return '';
        return new Intl.NumberFormat('id-ID').format(Number(digits));
    };

    // 1. Pure numeric price input (Paket Harga)
    document.querySelectorAll('[data-currency-input="true"]').forEach((input) => {
        input.addEventListener('input', () => {
            const cursor = input.selectionStart;
            const prevLen = input.value.length;
            const digits = input.value.replace(/\D/g, '');
            input.value = digits ? formatNumberDots(digits) : '';
            const newLen = input.value.length;
            const newPos = Math.max(0, cursor + (newLen - prevLen));
            input.setSelectionRange(newPos, newPos);
        });
    });

    // 2. Service price with Rp prefix & dots (Layanan Setting)
    document.querySelectorAll('[data-service-price="true"]').forEach((input) => {
        input.addEventListener('input', () => {
            const val = input.value.trim();
            if (/^(Rp\s?)?[\d\.\s]+(\/\s?\w+)?$/i.test(val)) {
                const hasSuffix = val.includes('/') ? ' ' + val.substring(val.indexOf('/')) : '';
                const digits = val.replace(/\D/g, '');
                if (digits) {
                    input.value = 'Rp ' + formatNumberDots(digits) + hasSuffix;
                }
            }
        });
    });
})();
