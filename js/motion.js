(() => {
    'use strict';

    const root = document.documentElement;
    const body = document.body;
    const reduceQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)');
    let reducedMotion = reduceQuery.matches;
    root.classList.add('motion-ready');

    const addReveal = (selector, className = 'motion-reveal') => {
        document.querySelectorAll(selector).forEach((element, index) => {
            element.classList.add(className);
            if (element.parentElement?.matches('.produtos-grade, .favoritos-grade')) {
                element.style.setProperty('--motion-delay', `${Math.min(index, 8) * 65}ms`);
            }
        });
    };

    document.querySelectorAll('[data-reveal]').forEach((title) => {
        const lines = [...title.querySelectorAll(':scope > .linha')];
        if (!lines.length) title.classList.add('reveal-fade');
        lines.forEach((line, index) => {
            line.classList.add('reveal-line');
            if (line.firstElementChild) line.firstElementChild.dataset.revealInner = '';
            line.style.setProperty('--reveal-delay', index);
        });
    });

    addReveal('.editorial-texto, .catalogo-banner, .catalogo-resumo, .catalogo-filtros, .catalogo-busca, .catalogo-vazio');
    addReveal('.produto-detalhe > .produto-voltar, .produto-galeria, .produto-compra, .produto-descricao, .produto-descricao dl div, .produto-nao-encontrado');
    addReveal('.favoritos-pagina > h1, .favoritos-introducao, .favoritos-erro, .favoritos-vazio');
    addReveal('.site-footer');

    document.querySelectorAll('.produtos-grade, .favoritos-grade, .colecoes-grade').forEach((grid) => {
        [...grid.children].forEach((card, index) => {
            card.classList.add('reveal-up');
            card.style.setProperty('--reveal-delay', `${Math.min(index, 8) * 65}ms`);
        });
    });
    document.querySelectorAll('.produto-galeria, [data-curtain]').forEach((element) => element.classList.add('image-reveal'));

    const reveals = document.querySelectorAll('.reveal, .reveal-up, .reveal-fade, .motion-reveal, [data-reveal]');
    let revealObserver = null;
    const showElement = (element) => element.classList.add('is-visible');
    if (reducedMotion || !('IntersectionObserver' in window)) {
        reveals.forEach(showElement);
        document.querySelectorAll('.image-reveal').forEach((element) => element.classList.add('image-visible'));
    } else {
        revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                showElement(entry.target);
                entry.target.classList.add('image-visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -36px 0px' });
        reveals.forEach((element) => revealObserver.observe(element));
        document.querySelectorAll('.image-reveal').forEach((element) => revealObserver.observe(element));
    }

    const hero = document.querySelector('.hero');
    if (hero) requestAnimationFrame(() => hero.classList.add('is-animated'));

    // Reading progress and compact header are updated in one scroll frame.
    let progress = document.querySelector('.progresso');
    if (!progress) {
        progress = document.createElement('div');
        progress.className = 'progresso';
        progress.setAttribute('aria-hidden', 'true');
        body.prepend(progress);
    }
    const header = document.querySelector('.header');
    let scrollFrame = 0;
    const parallaxElements = [...document.querySelectorAll('.editorial-foto img, .catalogo-banner img, .produto-galeria img')];
    const updateScrollState = () => {
        scrollFrame = 0;
        const maxScroll = Math.max(1, root.scrollHeight - window.innerHeight);
        progress.style.setProperty('--p', Math.min(1, window.scrollY / maxScroll).toFixed(4));
        if (header) {
            const scrolled = window.scrollY > 36;
            header.classList.toggle('is-scrolled', scrolled);
            header.classList.toggle('compacto', scrolled);
        }
        if (reducedMotion) return;
        const viewport = window.innerHeight;
        parallaxElements.forEach((element) => {
            const rect = element.getBoundingClientRect();
            if (rect.bottom < -80 || rect.top > viewport + 80) return;
            const distance = (rect.top + rect.height / 2 - viewport / 2) / viewport;
            const offset = Math.max(-24, Math.min(24, -distance * 15));
            element.style.setProperty('--scroll-parallax', `${offset.toFixed(1)}px`);
        });
        const footer = document.querySelector('.site-footer');
        if (footer) {
            const rect = footer.getBoundingClientRect();
            const distance = (rect.top + rect.height / 2 - viewport / 2) / viewport;
            footer.style.setProperty('--scroll-parallax', `${Math.max(-16, Math.min(16, -distance * 10)).toFixed(1)}px`);
        }
    };
    const requestScrollUpdate = () => {
        if (scrollFrame) return;
        scrollFrame = requestAnimationFrame(updateScrollState);
    };
    updateScrollState();
    window.addEventListener('scroll', requestScrollUpdate, { passive: true });
    window.addEventListener('resize', requestScrollUpdate, { passive: true });

    // Search panel: keyboard and outside-click dismissal.
    const searchToggle = document.querySelector('.header-busca-toggle');
    const searchPanel = document.querySelector('#busca-site');
    if (searchToggle && searchPanel) {
        const setSearchOpen = (open) => {
            searchPanel.hidden = !open;
            searchToggle.setAttribute('aria-expanded', String(open));
            if (open) window.setTimeout(() => searchPanel.querySelector('input')?.focus(), 30);
        };
        searchToggle.addEventListener('click', () => setSearchOpen(searchPanel.hidden));
        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape' || searchPanel.hidden) return;
            setSearchOpen(false);
            searchToggle.focus();
        });
        document.addEventListener('pointerdown', (event) => {
            if (!searchPanel.hidden && !searchPanel.contains(event.target) && !searchToggle.contains(event.target)) setSearchOpen(false);
        });
    }

    // Magnetic response and ripple feedback for controls throughout the site.
    const magneticTargets = document.querySelectorAll('.editorial-cta, .produto-favorito button, .favorito-remover button, .produto-favoritar button, .catalogo-busca button, .busca-site button, .botao-voltar-catalogo, .produto-voltar, .produto-tamanhos label, .header .menu-link, .header .header-acoes a, .header .header-busca-toggle');
    if (finePointer.matches && !reducedMotion) {
        magneticTargets.forEach((control) => {
            control.classList.add('motion-magnetic');
            control.addEventListener('pointermove', (event) => {
                const rect = control.getBoundingClientRect();
                const dx = (event.clientX - rect.left - rect.width / 2) / rect.width;
                const dy = (event.clientY - rect.top - rect.height / 2) / rect.height;
                control.style.setProperty('--mag-x', `${(dx * 5).toFixed(1)}px`);
                control.style.setProperty('--mag-y', `${(dy * 4).toFixed(1)}px`);
            });
            control.addEventListener('pointerleave', () => {
                control.style.setProperty('--mag-x', '0px');
                control.style.setProperty('--mag-y', '0px');
            });
        });
    }
    document.addEventListener('pointerdown', (event) => {
        const control = event.target.closest('button, .botao-voltar-catalogo, .produto-voltar, .filtro, .card-colecao');
        if (!control || reducedMotion) return;
        const rect = control.getBoundingClientRect();
        control.classList.add('motion-interactive');
        const ripple = document.createElement('span');
        ripple.className = 'motion-ripple';
        ripple.style.left = `${event.clientX - rect.left}px`;
        ripple.style.top = `${event.clientY - rect.top}px`;
        control.appendChild(ripple);
        ripple.addEventListener('animationend', () => ripple.remove(), { once: true });
    });

    // Editorial cursor follows a fine pointer and labels links contextually.
    if (finePointer.matches && !reducedMotion) {
        const cursor = document.createElement('div');
        cursor.className = 'motion-cursor';
        cursor.setAttribute('aria-hidden', 'true');
        cursor.innerHTML = '<span></span>';
        body.appendChild(cursor);
        body.classList.add('motion-cursor-ready');
        let mouseX = -40;
        let mouseY = -40;
        let cursorX = mouseX;
        let cursorY = mouseY;
        let cursorFrame = 0;
        const moveCursor = (event) => {
            cursor.classList.add('is-seen');
            mouseX = event.clientX;
            mouseY = event.clientY;
            if (!cursorFrame) cursorFrame = requestAnimationFrame(drawCursor);
        };
        const drawCursor = () => {
            cursorX += (mouseX - cursorX) * 0.22;
            cursorY += (mouseY - cursorY) * 0.22;
            cursor.style.transform = `translate3d(${cursorX}px, ${cursorY}px, 0) translate(-50%, -50%)`;
            if (Math.abs(mouseX - cursorX) > 0.4 || Math.abs(mouseY - cursorY) > 0.4) cursorFrame = requestAnimationFrame(drawCursor);
            else cursorFrame = 0;
        };
        document.addEventListener('pointermove', moveCursor, { passive: true });
        document.addEventListener('pointerover', (event) => {
            const target = event.target.closest('a, button, input, label');
            cursor.classList.toggle('is-active', Boolean(target));
            const label = target?.dataset.cursor || (target?.closest('.produto-card') ? 'VER PECA' : target?.closest('.card-colecao') ? 'EXPLORAR' : '');
            cursor.dataset.label = label;
        });
        document.addEventListener('pointerleave', () => cursor.classList.remove('is-active'));
    }

    // Smooth same-page anchors while preserving reduced-motion settings and history.
    document.addEventListener('click', (event) => {
        const link = event.target.closest('a[href*="#"]');
        if (!link || event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
        const url = new URL(link.href, location.href);
        if (url.pathname !== location.pathname || url.search !== location.search || !url.hash) return;
        const destination = document.getElementById(decodeURIComponent(url.hash.slice(1)));
        if (!destination) return;
        event.preventDefault();
        destination.scrollIntoView({ behavior: reducedMotion ? 'auto' : 'smooth', block: 'start' });
        history.replaceState(null, '', url.hash);
    });

    // Thumbnail support for future product gallery controls.
    document.addEventListener('click', (event) => {
        const thumbnail = event.target.closest('[data-gallery-src]');
        if (!thumbnail) return;
        const gallery = document.querySelector('.produto-galeria img');
        if (!gallery || !thumbnail.dataset.gallerySrc || gallery.src === new URL(thumbnail.dataset.gallerySrc, location.href).href) return;
        const nextSrc = thumbnail.dataset.gallerySrc;
        gallery.classList.add('is-changing');
        window.setTimeout(() => {
            gallery.src = nextSrc;
            gallery.addEventListener('load', () => gallery.classList.remove('is-changing'), { once: true });
            gallery.addEventListener('error', () => gallery.classList.remove('is-changing'), { once: true });
        }, reducedMotion ? 0 : 140);
    });

    reduceQuery.addEventListener?.('change', (event) => {
        reducedMotion = event.matches;
        if (reducedMotion) {
            reveals.forEach(showElement);
            document.querySelectorAll('.image-reveal').forEach((element) => element.classList.add('image-visible'));
        }
    });
})();
