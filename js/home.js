(() => {
    'use strict';

    /* ==========================================================
       LEWIS — HOME
       Animações e interações sem alterar o layout ou o visual-base.
       ========================================================== */

    const raiz = document.documentElement;
    raiz.classList.add('js');

    const reduzir = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    const mouseFino = window.matchMedia(
        '(hover: hover) and (pointer: fine)'
    ).matches && !reduzir;

    const $ = (seletor, contexto = document) =>
        contexto.querySelector(seletor);

    const $$ = (seletor, contexto = document) =>
        [...contexto.querySelectorAll(seletor)];

    const lerp = (a, b, t) => a + (b - a) * t;
    const clamp = (valor, minimo, maximo) =>
        Math.min(Math.max(valor, minimo), maximo);

    const header = $('.header');
    const hero = $('.hero');
    const heroMidia = $('.hero-midia');
    const heroConteudo = $('.hero-conteudo');
    const rodape = $('.rodape');
    const rodapeImg = $('.rodape > img');
    const botao = $('.botao-colecao');

    /* ---------- Barra de progresso ---------- */

    let barra = document.querySelector('.progresso');
    if (!barra) {
        barra = document.createElement('div');
        barra.className = 'progresso';
        barra.setAttribute('aria-hidden', 'true');
        document.body.prepend(barra);
    }

    /* ---------- Título das coleções: palavra por palavra ---------- */

    $$('.colecoes-cabecalho h2').forEach(titulo => {
        const texto = titulo.textContent.trim();
        titulo.setAttribute('aria-label', texto);

        titulo.innerHTML = texto.split(/\s+/).map((palavra, indice) =>
            `<span class="palavra" aria-hidden="true"><span style="--w:${indice}">${palavra}</span></span>`
        ).join(' ');
    });

    /* ---------- Cards: brilho e estado do cursor ---------- */

    const cards = $$('.card-colecao').map(elemento => {
        const brilho = document.createElement('i');
        brilho.className = 'brilho';
        brilho.setAttribute('aria-hidden', 'true');
        elemento.appendChild(brilho);

        return {
            el: elemento,
            img: $('img', elemento),
            tx: 0,
            ty: 0,
            cx: 0,
            cy: 0
        };
    });

    /* ---------- Estado do movimento ---------- */

    let alvoY = window.scrollY;
    let y = window.scrollY;
    let raf = 0;
    let ultimoY = window.scrollY;

    const botaoEstado = {
        tx: 0,
        ty: 0,
        cx: 0,
        cy: 0
    };

    const pedir = () => {
        if (!raf) raf = requestAnimationFrame(quadro);
    };

    /* ---------- Loop visual: só continua enquanto há movimento ---------- */

    function quadro() {
        raf = 0;
        let ativo = false;
        const vh = window.innerHeight;

        // Suaviza somente os efeitos visuais. A rolagem da página continua nativa.
        y = reduzir ? alvoY : lerp(y, alvoY, 0.1);

        if (Math.abs(alvoY - y) > 0.1) {
            ativo = true;
        } else {
            y = alvoY;
        }

        const atraso = window.scrollY - y;

        /* Barra de progresso */
        const max = raiz.scrollHeight - vh;
        const progresso = max > 0 ? clamp(y / max, 0, 1) : 0;
        barra.style.setProperty('--p', progresso.toFixed(4));

        /* Hero: parallax discreto e conteúdo que acompanha a rolagem */
        if (hero && heroMidia && heroConteudo) {
            const hh = hero.offsetHeight;

            if (!reduzir && y < hh * 1.2) {
                heroMidia.style.setProperty(
                    '--py',
                    `${(y * 0.2).toFixed(1)}px`
                );

                heroConteudo.style.setProperty(
                    '--hy',
                    `${(y * 0.12).toFixed(1)}px`
                );

                heroConteudo.style.setProperty(
                    '--ho',
                    (1 - clamp(y / (hh * 0.7), 0, 1)).toFixed(3)
                );
            }
        }

        /* Cards: movimento do cursor + parallax de rolagem */
        cards.forEach(card => {
            const r = card.el.getBoundingClientRect();
            const visivel = r.bottom > -150 && r.top < vh + 150;

            if (mouseFino) {
                card.cx = lerp(card.cx, card.tx, 0.07);
                card.cy = lerp(card.cy, card.ty, 0.07);

                if (
                    Math.abs(card.cx - card.tx) > 0.001 ||
                    Math.abs(card.cy - card.ty) > 0.001
                ) {
                    ativo = true;
                }
            }

            if (!visivel || reduzir || !card.img) return;

            const centro = (r.top + atraso) + r.height / 2;
            const p = clamp((centro - vh / 2) / vh, -1, 1);
            const ty = -p * r.height * 0.05;

            const deslocamentoX = mouseFino ? -card.cx * 14 : 0;
            const deslocamentoY = ty - (mouseFino ? card.cy * 10 : 0);

            card.img.style.translate =
                `${deslocamentoX.toFixed(1)}px ${deslocamentoY.toFixed(1)}px`;
        });

        /* Rodapé: parallax do fundo, sem mudar seu enquadramento */
        if (!reduzir && rodape && rodapeImg) {
            const r = rodape.getBoundingClientRect();

            if (r.top < vh && r.bottom > 0) {
                const p = clamp(
                    ((r.top + atraso) + r.height / 2 - vh / 2) / vh,
                    -1,
                    1
                );

                rodapeImg.style.translate =
                    `0 ${(-p * r.height * 0.08).toFixed(1)}px`;
            }
        }

        /* Botão magnético: efeito pequeno, somente com mouse */
        if (botao && mouseFino) {
            botaoEstado.cx = lerp(botaoEstado.cx, botaoEstado.tx, 0.12);
            botaoEstado.cy = lerp(botaoEstado.cy, botaoEstado.ty, 0.12);

            if (
                Math.abs(botaoEstado.cx - botaoEstado.tx) > 0.05 ||
                Math.abs(botaoEstado.cy - botaoEstado.ty) > 0.05
            ) {
                ativo = true;
            }

            botao.style.translate =
                `${botaoEstado.cx.toFixed(1)}px ${botaoEstado.cy.toFixed(1)}px`;
        }

        if (ativo) pedir();
    }

    /* ---------- Scroll: story parallax and header state ---------- */

    window.addEventListener('scroll', () => {
        alvoY = window.scrollY;
        const descendo = alvoY > ultimoY;
        if (header) {
            header.classList.toggle('compacto', alvoY > 36);
            header.classList.toggle('is-scrolled', alvoY > 36);
            header.classList.toggle('descendo', descendo && alvoY > 240);
        }
        ultimoY = alvoY;
        pedir();
    }, { passive: true });
    window.addEventListener('resize', pedir, { passive: true });

    /* ---------- Mouse: brilho dos cards ---------- */

    if (mouseFino) {
        cards.forEach(card => {
            card.el.addEventListener('pointermove', evento => {
                const r = card.el.getBoundingClientRect();
                const px = (evento.clientX - r.left) / r.width;
                const py = (evento.clientY - r.top) / r.height;

                card.el.style.setProperty('--mx', `${(px * 100).toFixed(1)}%`);
                card.el.style.setProperty('--my', `${(py * 100).toFixed(1)}%`);
                card.el.style.setProperty('--tilt-x', `${((px - 0.5) * 5).toFixed(2)}deg`);
                card.el.style.setProperty('--tilt-y', `${((0.5 - py) * 5).toFixed(2)}deg`);

                card.tx = (px - 0.5) * 2;
                card.ty = (py - 0.5) * 2;
                pedir();
            });

            card.el.addEventListener('pointerenter', () => {
                cards.forEach(other => other.el.classList.toggle('is-dimmed', other.el !== card.el));
            });
            card.el.addEventListener('pointerleave', () => {
                card.tx = 0;
                card.ty = 0;
                card.el.style.setProperty('--tilt-x', '0deg');
                card.el.style.setProperty('--tilt-y', '0deg');
                cards.forEach(other => other.el.classList.remove('is-dimmed'));
                pedir();
            });
        });

        /* ---------- Botão: preenchimento acompanha o cursor ---------- */

        if (botao) {
            botao.addEventListener('pointermove', evento => {
                const r = botao.getBoundingClientRect();
                const px = (evento.clientX - r.left) / r.width;
                const py = (evento.clientY - r.top) / r.height;

                botao.style.setProperty('--bx', `${(px * 100).toFixed(1)}%`);
                botao.style.setProperty('--by', `${(py * 100).toFixed(1)}%`);

                botaoEstado.tx = (px - 0.5) * 14;
                botaoEstado.ty = (py - 0.5) * 10;
                pedir();
            });

            botao.addEventListener('pointerleave', () => {
                botaoEstado.tx = 0;
                botaoEstado.ty = 0;
                pedir();
            });
        }
    }

    /* ---------- Revelação ao rolar ---------- */

    const itens = $$('.reveal');

    if (!('IntersectionObserver' in window) || reduzir) {
        itens.forEach(elemento => {
            elemento.classList.add('visivel', 'pronto');
        });
    } else {
        const observador = new IntersectionObserver(entradas => {
            entradas.forEach(entrada => {
                if (!entrada.isIntersecting) return;

                const elemento = entrada.target;
                elemento.classList.add('visivel');
                observador.unobserve(elemento);

                // Remove o atraso depois da entrada para não interferir nos hovers.
                window.setTimeout(() => {
                    elemento.classList.add('pronto');
                }, 2800);
            });
        }, {
            threshold: 0.18,
            rootMargin: '0px 0px -6% 0px'
        });

        itens.forEach(elemento => observador.observe(elemento));
    }

    /* ---------- Links de âncora: o CSS já define scroll-behavior ---------- */

    // Não interceptamos os links; o comportamento nativo mantém acessibilidade,
    // histórico do navegador e a rolagem suave já definida em home.css.

    pedir();
})();
