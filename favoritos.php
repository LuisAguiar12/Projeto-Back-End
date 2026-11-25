<?php
require __DIR__ . "/data/produtos.php";
require __DIR__ . "/data/sessao_favoritos.php";

$produtosPorId = [];
foreach ($produtos as $produto) {
    $produtosPorId[$produto->id_produto] = $produto;
}

$mensagemErro = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tokenEnviado = $_POST["token_favoritos"] ?? "";
    if (!is_string($tokenEnviado) || !hash_equals($tokenFavoritos, $tokenEnviado)) {
        http_response_code(403);
        $mensagemErro = "Não foi possível confirmar esta ação. Atualize a página e tente novamente.";
    } else {
        $acao = $_POST["acao"] ?? "";
        $idProduto = filter_var($_POST["id_produto"] ?? null, FILTER_VALIDATE_INT);
        if (!is_string($acao) || !isset($produtosPorId[$idProduto])) {
            http_response_code(400);
            $mensagemErro = "Não foi possível atualizar seus favoritos.";
        } elseif ($acao === "alternar") {
            if (in_array($idProduto, $idsFavoritos, true)) {
                $idsFavoritos = array_values(array_diff($idsFavoritos, [$idProduto]));
            } else {
                $idsFavoritos[] = $idProduto;
            }
        } elseif ($acao === "remover") {
            $idsFavoritos = array_values(array_diff($idsFavoritos, [$idProduto]));
        } else {
            http_response_code(400);
            $mensagemErro = "Ação de favorito inválida.";
        }

        if ($mensagemErro === "") {
            $_SESSION["ids_favoritos"] = $idsFavoritos;
            $returnTo = $_POST["return_to"] ?? "./favoritos.php";
            if (!is_string($returnTo) || !preg_match('~^\./(?:favoritos\.php|catalogo\.php(?:\?[^\r\n]*)?|produto\.php\?id=[0-9]+)$~', $returnTo)) {
                $returnTo = "./favoritos.php";
            }
            header("Location: " . $returnTo);
            exit;
        }
    }
}

$produtosFavoritos = [];
foreach ($idsFavoritos as $idFavorito) {
    if (isset($produtosPorId[$idFavorito])) {
        $produtosFavoritos[] = $produtosPorId[$idFavorito];
    }
}

function escaparFavoritos($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos | LEWIS</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/produto-favoritos.css">
    <link rel="stylesheet" href="./css/motion.css">
</head>

<body>
    <?php require __DIR__ . "/view/header.php"; ?>

    <main class="favoritos-pagina">
        <h1 data-reveal>Favoritos</h1>
        <p class="favoritos-introducao">As peças que você guardou para ver depois.</p>

        <?php if ($mensagemErro !== ""): ?>
            <p class="favoritos-erro" role="alert"><?= escaparFavoritos($mensagemErro) ?></p>
        <?php endif; ?>

        <?php if ($produtosFavoritos): ?>
            <div class="favoritos-grade">
                <?php foreach ($produtosFavoritos as $produto): ?>
                    <?php
                    $imagem = $produto->imagem;
                    ?>
                    <article class="favorito-card">
                        <a class="favorito-imagem" data-curtain href="./produto.php?id=<?= (int) $produto->id_produto ?>">
                            <img
                                src="<?= escaparFavoritos($imagem) ?>"
                                alt="<?= escaparFavoritos($produto->nome) ?>"
                                loading="lazy"
                                decoding="async">
                        </a>
                        <div class="favorito-informacoes">
                            <a class="favorito-nome" href="./produto.php?id=<?= (int) $produto->id_produto ?>">
                                <?= escaparFavoritos($produto->nome) ?>
                            </a>
                            <span><?= escaparFavoritos($produto->genero) ?></span>
                            <p>R$ <?= number_format((float) $produto->preco, 2, ",", ".") ?></p>
                        </div>
                        <form class="favorito-remover" action="./favoritos.php" method="post">
                            <input type="hidden" name="token_favoritos" value="<?= escaparFavoritos($tokenFavoritos) ?>">
                            <input type="hidden" name="acao" value="remover">
                            <input type="hidden" name="id_produto" value="<?= (int) $produto->id_produto ?>">
                            <input type="hidden" name="return_to" value="./favoritos.php">
                            <button type="submit" aria-label="Remover <?= escaparFavoritos($produto->nome) ?> dos favoritos">×</button>
                        </form>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <section class="favoritos-vazio">
                <p>Você ainda não adicionou produtos aos favoritos.</p>
                <a class="botao-voltar-catalogo" href="./catalogo.php">Explorar catálogo</a>
            </section>
        <?php endif; ?>
    </main>

    <?php require __DIR__ . "/view/footer.php"; ?>
</body>

</html>
