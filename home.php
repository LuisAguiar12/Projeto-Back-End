<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lewis - Início</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/home.css">
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
                <h1 id="hero-title">
                    <span class="linha"><span>Estilo é</span></span>
                    <span class="linha"><span>uma forma</span></span>
                    <span class="linha"><span>de expressar</span></span>
                    <span class="linha"><span>quem você é.</span></span>
                </h1>
                <p>Roupas que acompanham<br>os melhores momentos.</p>
                <a class="botao-colecao" href="catalogo.html"><span>Ver coleção</span></a>
            </div>

            <a class="hero-rolar" href="#colecoes" aria-label="Rolar para as coleções">
                <span>Explore</span>
                <i aria-hidden="true"></i>
            </a>
        </section>
    </main>
    <script src="./js/home.js" defer></script>
</body>
</html>