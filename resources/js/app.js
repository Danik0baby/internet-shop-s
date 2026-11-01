const menuToggle = document.querySelector('[data-menu-toggle]');
const mobileMenu = document.querySelector('[data-mobile-menu]');

if (menuToggle && mobileMenu) {
    const setMenuState = (open) => {
        mobileMenu.classList.toggle('hidden', !open);
        menuToggle.setAttribute('aria-expanded', String(open));
    };

    menuToggle.addEventListener('click', () => {
        setMenuState(mobileMenu.classList.contains('hidden'));
    });

    mobileMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setMenuState(false));
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setMenuState(false);
        }
    });
}

const filterButtons = document.querySelectorAll('[data-filter]');
const productCards = document.querySelectorAll('[data-product-category]');
const productCount = document.querySelector('[data-product-count]');
const emptyState = document.querySelector('[data-empty-state]');

const applyFilter = (filter) => {
    filterButtons.forEach((chip) => {
        chip.setAttribute('aria-pressed', String(chip.dataset.filter === filter));
    });

    let visibleProducts = 0;

    productCards.forEach((card) => {
        const matches = filter === 'all' || card.dataset.productCategory === filter;

        card.classList.toggle('hidden', !matches);

        if (matches) {
            visibleProducts += 1;
        }
    });

    if (emptyState) {
        emptyState.classList.toggle('hidden', visibleProducts > 0);
    }

    if (productCount) {
        productCount.textContent = String(visibleProducts);
    }
};

filterButtons.forEach((button) => {
    button.addEventListener('click', () => applyFilter(button.dataset.filter));
});

const initialCategory = new URLSearchParams(window.location.search).get('category');

if (initialCategory && document.querySelector(`[data-filter="${CSS.escape(initialCategory)}"]`)) {
    applyFilter(initialCategory);
}

const cartCounter = document.querySelector('[data-cart-count]');

document.querySelectorAll('[data-add-to-cart]').forEach((button) => {
    button.addEventListener('click', () => {
        const count = Number(cartCounter?.textContent ?? 0) + 1;

        if (cartCounter) {
            cartCounter.textContent = String(count);
            cartCounter.classList.remove('hidden');
        }

        const label = button.dataset.label ?? button.textContent;
        button.dataset.label = label;
        button.textContent = 'Добавлено';
        button.disabled = true;

        window.setTimeout(() => {
            button.textContent = label;
            button.disabled = false;
        }, 1200);
    });
});
