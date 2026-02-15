import './bootstrap';

const modals = Array.from(document.querySelectorAll('[data-modal]'));
const openButtons = Array.from(document.querySelectorAll('[data-modal-target]'));
const closeButtons = Array.from(document.querySelectorAll('[data-modal-close]'));

const setModalState = (modal, isOpen) => {
    if (!modal) return;
    const panel = modal.querySelector('[data-modal-panel]');
    modal.classList.toggle('hidden', !isOpen);
    modal.classList.toggle('flex', isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
    if (panel) {
        if (isOpen) {
            requestAnimationFrame(() => panel.classList.add('is-open'));
        } else {
            panel.classList.remove('is-open');
        }
    }
};

const closeAllModals = () => {
    modals.forEach((modal) => setModalState(modal, false));
};

openButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const target = button.dataset.modalTarget;
        const modal = document.querySelector(`[data-modal=\"${target}\"]`);

        if (target === 'talent') {
            const title = button.dataset.talentTitle;
            const description = button.dataset.talentDescription;
            const jobsRaw = button.dataset.talentJobs;
            const jobs = jobsRaw ? JSON.parse(jobsRaw) : [];

            const titleEl = modal?.querySelector('[data-talent-title]');
            const descEl = modal?.querySelector('[data-talent-description]');
            const listEl = modal?.querySelector('[data-talent-jobs]');

            const applyGridColumns = (el, count) => {
                if (!el) return;
                el.classList.remove('grid-cols-1', 'md:grid-cols-2', 'lg:grid-cols-3', 'lg:grid-cols-4');
                el.classList.add('grid-cols-1');

                if (count === 2) {
                    el.classList.add('md:grid-cols-2');
                } else if (count === 3) {
                    el.classList.add('md:grid-cols-2', 'lg:grid-cols-3');
                } else if (count >= 4) {
                    el.classList.add('md:grid-cols-2', 'lg:grid-cols-4');
                }
            };

            if (titleEl) titleEl.textContent = title || '';
            if (descEl) descEl.textContent = description || '';
            if (listEl) {
                applyGridColumns(listEl, jobs.length);
                if (!jobs.length) {
                    listEl.innerHTML = `
                        <div class=\"col-span-full rounded-2xl border border-[#ececf4] p-4\">
                            <p class=\"text-sm text-[#6b6b66]\">No careers available in this category yet.</p>
                        </div>
                    `;
                } else {
                    listEl.innerHTML = jobs
                        .map(
                            (job) => `
                        <article class=\"overflow-hidden rounded-xl border border-[#e2e5ee] bg-white shadow-sm\">
                            ${job.thumbnail ? `<img src=\"${job.thumbnail}\" alt=\"${job.title}\" class=\"h-40 w-full object-cover\" draggable=\"false\">` : '<div class=\"h-40 w-full bg-[#eef2f7]\"></div>'}
                            <div class=\"p-4\">
                                <h4 class=\"text-lg font-semibold text-[#111]\">${job.title}</h4>
                                <p class=\"mt-2 text-sm leading-relaxed text-[#5a5a66]\">${job.description || ''}</p>
                            </div>
                        </article>
                    `
                        )
                        .join('');
                }
            }
        }

        closeAllModals();
        setModalState(modal, true);
    });
});

closeButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const modal = button.closest('[data-modal]');
        setModalState(modal, false);
    });
});

modals.forEach((modal) => {
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            setModalState(modal, false);
        }
    });
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeAllModals();
    }
});

const scrollTopButton = document.querySelector('[data-scroll-top]');

if (scrollTopButton) {
    scrollTopButton.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    const toggleScrollTop = () => {
        const scrollThreshold = document.documentElement.scrollHeight * 0.25;
        const current = window.scrollY + window.innerHeight;
        const shouldShow = current >= scrollThreshold;
        scrollTopButton.classList.toggle('hidden', !shouldShow);
    };

    toggleScrollTop();
    window.addEventListener('scroll', toggleScrollTop, { passive: true });
}

const initAos = () => {
    if (!window.AOS) return false;
    window.AOS.init({ duration: 800, easing: 'ease-out', once: true });
    return true;
};

if (!initAos()) {
    window.addEventListener('load', () => {
        initAos();
    });
}

const dropdowns = Array.from(document.querySelectorAll('[data-dropdown]'));

const closeDropdowns = () => {
    dropdowns.forEach((dropdown) => {
        const menu = dropdown.querySelector('[data-dropdown-menu]');
        if (menu) {
            menu.classList.add('hidden');
        }
    });
};

dropdowns.forEach((dropdown) => {
    const trigger = dropdown.querySelector('[data-dropdown-trigger]');
    const menu = dropdown.querySelector('[data-dropdown-menu]');

    if (!trigger || !menu) return;

    trigger.addEventListener('click', (event) => {
        event.preventDefault();
        const isHidden = menu.classList.contains('hidden');
        closeDropdowns();
        if (isHidden) {
            menu.classList.remove('hidden');
        }
    });
});

document.addEventListener('click', (event) => {
    if (!event.target.closest('[data-dropdown]')) {
        closeDropdowns();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeDropdowns();
    }
});

const tabs = Array.from(document.querySelectorAll('[data-tabs]'));

tabs.forEach((tabsRoot) => {
    const tabButtons = Array.from(tabsRoot.querySelectorAll('[data-tab]'));
    const tabPanels = Array.from(tabsRoot.querySelectorAll('[data-tab-panel]'));

    if (tabButtons.length === 0 || tabPanels.length === 0) return;

    const activateTab = (tabName) => {
        tabButtons.forEach((button) => {
            const isActive = button.dataset.tab === tabName;
            button.classList.toggle('text-[#287854]', isActive);
            button.classList.toggle('text-[#2e2e2e]', !isActive);
            button.classList.toggle('bg-[#e6f1ec]', isActive);
        });

        tabPanels.forEach((panel) => {
            const isActive = panel.dataset.tabPanel === tabName;
            panel.classList.toggle('hidden', !isActive);
        });
    };

    const firstTab = tabButtons[0].dataset.tab;
    activateTab(firstTab);

    tabButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            activateTab(button.dataset.tab);
        });
    });
});
