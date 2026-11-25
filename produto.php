<?php
require __DIR__ . "/data/produtos.php";
require __DIR__ . "/data/sessao_favoritos.php";

$idProduto = filter_var($_GET["id"] ?? null, FILTER_VALIDATE_INT);
$produto = null;
foreach ($produtos as $item) {
    if ($idProduto !== false && $item->id_produto === $idProduto) {
        $produto = $item;
        break;
    }
}

if ($produto === null) {
    http_response_code(404);
}

function escaparProduto($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}

$favorito = $produto !== null && in_array($produto->id_produto, $idsFavoritos, true);
$imagem = $produto !== null ? $produto->imagem : null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $produto ? escaparProduto($produto->nome) . " | LEWIS" : "Produto não encontrado | LEWIS" ?></title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/produto-favoritos.css">
    <link rel="stylesheet" href="./css/motion.css">
</head>

<body>
    <?php require __DIR__ . "/view/header.php"; ?>

    <main>
        <?php if ($produto === null): ?>
            <section class="produto-nao-encontrado">
                <h1>Produto não encontrado</h1>
                <p>Este produto não está disponível no catálogo.</p>
                <a class="botao-voltar-catalogo" href="./catalogo.php">Voltar ao catálogo</a>
            </section>
        <?php else: ?>
            <div class="produto-detalhe">
                <a class="produto-voltar" href="./catalogo.php" aria-label="Voltar ao catálogo">← Voltar ao catálogo</a>

                <div class="produto-galeria" data-curtain>
                    <img
                        src="<?= escaparProduto($imagem) ?>"
                        alt="<?= escaparProduto($produto->nome) ?>"
                        fetchpriority="high">
                </div>

                <section class="produto-compra" aria-labelledby="produto-nome">
                    <h1 id="produto-nome" data-reveal><?= escaparProduto($produto->nome) ?></h1>
                    <span class="produto-genero"><?= escaparProduto($produto->genero) ?></span>
                    <p class="produto-valor">R$ <?= number_format((float) $produto->preco, 2, ",", ".") ?></p>

                    <fieldset class="produto-tamanhos">
                        <legend>Tamanho</legend>
                        <?php foreach (["P", "M", "G", "GG"] as $tamanho): ?>
                            <label>
                                <input type="radio" name="tamanho" value="<?= $tamanho ?>">
                                <span><?= $tamanho ?></span>
                            </label>
                        <?php endforeach; ?>
                    </fieldset>

                    <form class="produto-favoritar" action="./favoritos.php" method="post">
                        <input type="hidden" name="token_favoritos" value="<?= escaparProduto($tokenFavoritos) ?>">
                        <input type="hidden" name="acao" value="alternar">
                        <input type="hidden" name="id_produto" value="<?= (int) $produto->id_produto ?>">
                        <input type="hidden" name="return_to" value="./produto.php?id=<?= (int) $produto->id_produto ?>">
                        <button type="submit" class="<?= $favorito ? "favorito-ativo" : "" ?>">
                            <?= $favorito ? "♥ Remover dos favoritos" : "♡ Adicionar aos favoritos" ?>
                        </button>
                    </form>
                </section>

                <aside class="produto-descricao">
                    <h2>Descrição</h2>
                    <p><?= escaparProduto($produto->descricao) ?></p>
                    <dl>
                        <div>
                            <dt>Categoria</dt>
                            <dd><?= escaparProduto($produto->categoria) ?></dd>
                        </div>
                        <div>
                            <dt>Referência</dt>
                            <dd>#<?= (int) $produto->id_produto ?></dd>
                        </div>
                    </dl>
                </aside>
            </div>
        <?php endif; ?>
    </main>

    <?php require __DIR__ . "/view/footer.php"; ?>
</body>

</html>
