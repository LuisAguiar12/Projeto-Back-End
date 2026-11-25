<?php
require __DIR__ . "/data/produtos.php";
require __DIR__ . "/data/sessao_favoritos.php";

$categorias = [
    "Todos" => null,
    "Feminino" => "Feminino",
    "Masculino" => "Masculino",
];

$categoriaSelecionada = $_GET["categoria"] ?? "Todos";
if (!is_string($categoriaSelecionada) || !array_key_exists($categoriaSelecionada, $categorias)) {
    $categoriaSelecionada = "Todos";
}

$genero = $categorias[$categoriaSelecionada];
$busca = trim((string) ($_GET["busca"] ?? ""));
$normalizarBusca = static function ($valor) {
    return function_exists("mb_strtolower") ? mb_strtolower((string) $valor, "UTF-8") : strtolower((string) $valor);
};
$termoBusca = $normalizarBusca($busca);
$produtosExibidos = array_values(array_filter(
    $produtos,
    static function ($produto) use ($genero, $termoBusca, $normalizarBusca) {
        if ($genero !== null && $produto->genero !== $genero) return false;
        if ($termoBusca === "") return true;
        $textoProduto = $normalizarBusca(implode(" ", [$produto->nome, $produto->genero, $produto->categoria, $produto->descricao]));
        return strpos($textoProduto, $termoBusca) !== false;
    }
));

function escaparCatalogo($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Conheça a coleção Lewis: peças de alfaiataria e estilo para todos.">
    <title>LEWIS | Catálogo</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/motion.css">
</head>

<body>
    <?php require __DIR__ . "/view/header.php"; ?>

    <main>
        <section class="catalogo-banner" aria-label="Coleção Lewis">
            <img src="./image/imagens_catalogo/topo_catalogo.svg" alt="Banner da coleção Lewis">
        </section>

        <section class="catalogo-conteudo" aria-label="Produtos da coleção">
            <form class="catalogo-busca" action="./catalogo.php" method="get" role="search">
                <?php if ($categoriaSelecionada !== "Todos"): ?>
                    <input type="hidden" name="categoria" value="<?= escaparCatalogo($categoriaSelecionada) ?>">
                <?php endif; ?>
                <label class="visualmente-oculto" for="busca-catalogo">Buscar produtos</label>
                <input id="busca-catalogo" name="busca" type="search" value="<?= escaparCatalogo($busca) ?>" placeholder="Buscar no cat&#225;logo">
                <button type="submit" aria-label="Buscar produtos">Buscar</button>
            </form>

            <nav class="catalogo-filtros" aria-label="Filtrar produtos por público">
                <?php foreach ($categorias as $nomeCategoria => $generoCategoria): ?>
                    <a
                        class="filtro<?= $categoriaSelecionada === $nomeCategoria ? " ativo" : "" ?>"
                        href="catalogo.php?categoria=<?= rawurlencode($nomeCategoria) ?><?= $busca !== "" ? "&busca=" . rawurlencode($busca) : "" ?>"
                        <?= $categoriaSelecionada === $nomeCategoria ? 'aria-current="page"' : "" ?>>
                        <?= escaparCatalogo($nomeCategoria) ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="catalogo-resumo">
                <p><?= count($produtosExibidos) ?> <?= count($produtosExibidos) === 1 ? "peça disponível" : "peças disponíveis" ?></p>
                <span>Novos clássicos para o seu guarda-roupa</span>
            </div>

            <?php if ($produtosExibidos): ?>
                <div class="produtos-grade">
                    <?php foreach ($produtosExibidos as $produto): ?>
                        <?php
                        $imagem = $produto->imagem;
                        $favorito = in_array($produto->id_produto, $idsFavoritos, true);
                        ?>
                        <article class="produto-card">
                            <a class="produto-imagem" data-curtain href="./produto.php?id=<?= (int) $produto->id_produto ?>">
                                <img
                                    src="<?= escaparCatalogo($imagem) ?>"
                                    alt="<?= escaparCatalogo($produto->nome) ?>"
                                    loading="lazy"
                                    decoding="async">
                            </a>
                            <form class="produto-favorito" action="./favoritos.php" method="post">
                                <input type="hidden" name="token_favoritos" value="<?= escaparCatalogo($tokenFavoritos) ?>">
                                <input type="hidden" name="acao" value="alternar">
                                <input type="hidden" name="id_produto" value="<?= (int) $produto->id_produto ?>">
                                <input type="hidden" name="return_to" value="./catalogo.php?categoria=<?= rawurlencode($categoriaSelecionada) ?><?= $busca !== "" ? "&busca=" . rawurlencode($busca) : "" ?>">
                                <button type="submit" aria-label="<?= $favorito ? "Remover" : "Adicionar" ?> <?= escaparCatalogo($produto->nome) ?> <?= $favorito ? "dos" : "aos" ?> favoritos">
                                    <span aria-hidden="true"><?= $favorito ? "♥" : "♡" ?></span>
                                </button>
                            </form>
                            <div class="produto-informacoes">
                                <div class="produto-identificacao">
                                    <h2 data-reveal><a href="./produto.php?id=<?= (int) $produto->id_produto ?>"><?= escaparCatalogo($produto->nome) ?></a></h2>
                                    <span><?= escaparCatalogo($produto->genero) ?></span>
                                </div>
                                <p class="produto-categoria"><?= escaparCatalogo($produto->categoria) ?></p>
                                <p class="produto-descricao"><?= escaparCatalogo($produto->descricao) ?></p>
                                <p class="produto-preco">R$ <?= number_format((float) $produto->preco, 2, ",", ".") ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="catalogo-vazio">Ainda não há produtos nesta seleção.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php require __DIR__ . "/view/footer.php"; ?>
</body>

</html>
