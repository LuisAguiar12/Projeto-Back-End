<?php
require_once __DIR__ . "/../data/sessao_favoritos.php";
?>
<header class="header" id="inicio">
        <nav class="header-navegacao" aria-label="Navegação principal">
            <a class="menu-link" href="./home.php" aria-label="Home"><img class="menu-icone" src="./image/home.svg" alt=""></a>
            <a class="menu-link" href="./catalogo.php" aria-label="Catálogo"><img class="menu-icone menu-icone--catalogo" src="./image/catalog.svg" alt=""></a>
        </nav>

        <a class="header-logo" href="./home.php" aria-label="Lewis - início">
            <img src="./image/Lewis_Logo.svg" alt="Lewis">
        </a>

        <nav class="header-acoes" aria-label="Busca e conta">
            <button class="header-busca-toggle" type="button" aria-label="Abrir busca" aria-expanded="false" aria-controls="busca-site"><img src="./image/search.svg" alt=""></button>
            <a href="./login.html" aria-label="Minha conta"><img src="./image/account-circle.svg" alt=""></a>
            <a class="header-favoritos" href="./favoritos.php" aria-label="Favoritos, <?= count($idsFavoritos) ?> itens favoritados">
                <img src="./image/heart-filled.svg" alt="">
                <?php if (count($idsFavoritos) > 0): ?><span class="favoritos-contador" aria-hidden="true"><?= count($idsFavoritos) ?></span><?php endif; ?>
            </a>
        </nav>
        <form class="busca-site" id="busca-site" action="./catalogo.php" method="get" role="search" hidden>
            <label for="busca-site-input">O que voc&#234; procura?</label>
            <div><input id="busca-site-input" type="search" name="busca" placeholder="Buscar produtos" required><button type="submit">Buscar</button></div>
        </form>
    </header>