<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lewis - Início</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/motion.css">
</head>

<body>
    <?php include './view/header.php'; ?>
    <main>
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-midia">
                <img class="hero-imagem" src="./image/Dupla elegante diante de arquitetura clássica.png"
                    alt="Casal usando looks elegantes em frente a uma arquitetura clássica" fetchpriority="high">
            </div>

            <div class="hero-conteudo">
                <span class="hero-filete" aria-hidden="true"></span>
                <h1 id="hero-title" data-reveal>
                    <span class="linha"><span>Estilo é</span></span>
                    <span class="linha"><span>uma forma</span></span>
                    <span class="linha"><span>de expressar</span></span>
                    <span class="linha"><span>quem você é.</span></span>
                </h1>
                <p>Roupas que acompanham<br>os melhores momentos.</p>
                <a class="botao-colecao" href="./catalogo.php"><span>Ver coleção</span></a>
            </div>

            <a class="hero-rolar" href="#colecoes" aria-label="Rolar para as coleções">
                <span>Explore</span>
                <i aria-hidden="true"></i>
            </a>
        </section>
        <section class="colecoes" id="colecoes" aria-labelledby="colecoes-titulo">
            <header class="colecoes-cabecalho reveal">
                <span class="colecoes-sobretitulo">A Coleção</span>
                <h2 id="colecoes-titulo" data-reveal>Nossas Categorias</h2>
                <span class="colecoes-filete" aria-hidden="true"></span>
            </header>

            <div class="colecoes-grade">
                <a class="card-colecao reveal" data-curtain style="--i:0" href="./catalogo.php?categoria=Feminino">
                    <img src="./image/card_feminino_820x700.png" alt="Mulher vestindo um look elegante feminino"
                        width="820" height="700" loading="lazy" decoding="async">
                    <span class="card-colecao-conteudo">
                        <span class="card-colecao-titulo">Feminino</span>
                        <span class="card-colecao-link">Ver produtos <span aria-hidden="true">→</span></span>
                    </span>
                </a>

                <a class="card-colecao reveal" data-curtain style="--i:1" href="./catalogo.php?categoria=Masculino">
                    <img src="./image/card_masculino_820x700.png" alt="Homem vestindo um look elegante masculino"
                        width="820" height="700" loading="lazy" decoding="async">
                    <span class="card-colecao-conteudo">
                        <span class="card-colecao-titulo">Masculino</span>
                        <span class="card-colecao-link">Ver produtos <span aria-hidden="true">→</span></span>
                    </span>
                </a>

                <a class="card-colecao reveal" data-curtain style="--i:2" href="./catalogo.php">
                    <img src="./image/mais_vendidos.svg" alt="Peças mais vendidas da Lewis" width="820"
                        height="700" loading="lazy" decoding="async">
                    <span class="card-colecao-conteudo">
                        <span class="card-colecao-titulo">Mais Vendidos</span>
                        <span class="card-colecao-link">Ver produtos <span aria-hidden="true">→</span></span>
                    </span>
                </a>

                <a class="card-colecao reveal" data-curtain style="--i:3" href="./catalogo.php?categoria=Todos">
                    <img src="./image/todos.svg" alt="Toda a coleção Lewis" width="820" height="700"
                        loading="lazy" decoding="async">
                    <span class="card-colecao-conteudo">
                        <span class="card-colecao-titulo">Todos</span>
                        <span class="card-colecao-link">Ver produtos <span aria-hidden="true">→</span></span>
                    </span>
                </a>
            </div>

            <section class="editorial-destaque" aria-labelledby="editorial-titulo">
                <a class="editorial-foto" data-curtain data-cursor="VER A PECA" href="./produto.php?id=2" aria-label="Conhecer o Blazer Feminino Alfaiataria">
                    <img src="./image/imagens_catalogo/Blazer Alfaiataria (Femenino).png" alt="Look de alfaiataria Lewis em tons claros, usado diante de uma fachada classica" loading="lazy" decoding="async">
                    <span class="editorial-foto-indice" aria-hidden="true">LEWIS / 02</span>
                    <span class="editorial-foto-link" aria-hidden="true">Ver a peca <b>?</b></span>
                </a>
                <div class="editorial-texto motion-reveal">
                    <span class="editorial-sobretitulo">Uma escolha para durar</span>
                    <h2 id="editorial-titulo" data-reveal>
                        <span class="linha"><span>Eleg&acirc;ncia</span></span>
                        <span class="linha"><span>que permanece.</span></span>
                    </h2>
                    <p>Alfaiataria feminina de linhas precisas e presen&ccedil;a leve. Uma pe&ccedil;a pensada para acompanhar diferentes momentos, sem perder a sua assinatura.</p>
                    <div class="editorial-produto">
                        <span>Em foco</span>
                        <strong>Blazer Feminino Alfaiataria</strong>
                        <span>R$ 349,90</span>
                    </div>
                    <a class="editorial-cta" href="./produto.php?id=2" data-cursor="DESCOBRIR">Conhecer a pe&ccedil;a <span aria-hidden="true">&#8599;</span></a>
                </div>
                <span class="editorial-numero" aria-hidden="true">01</span>
            </section>

            <ul class="beneficios" id="beneficios" aria-label="Benefícios Lewis">
                <li class="beneficio reveal" style="--i:0">
                    <img src="./image/truck.svg" alt="" aria-hidden="true">
                    <span>Entrega segura<br>e rápida</span>
                </li>
                <li class="beneficio reveal" style="--i:1">
                    <img src="./image/diamond.svg" alt="" aria-hidden="true">
                    <span>Produtos<br>de alta qualidade</span>
                </li>
                <li class="beneficio reveal" style="--i:2">
                    <img src="./image/credit_card.svg" alt="" aria-hidden="true">
                    <span>Pagamento<br>seguro</span>
                </li>
                <li class="beneficio reveal" style="--i:3">
                    <img src="./image/headset.svg" alt="" aria-hidden="true">
                    <span>Atendimento<br>personalizado</span>
                </li>
            </ul>
        </section>
    </main>
    <?php include './view/footer.php'; ?>
</body>

</html>
