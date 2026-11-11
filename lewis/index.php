

<?php
require "./data/conexao.php";

// Verifica qual categoria foi selecionada
$categoria = $_GET['categoria'] ?? 'Mais Vendidos';

// Busca os produtos
if ($categoria == 'Mais Vendidos') {

    $sql = "SELECT * FROM produtos WHERE destaque = 1";

} elseif ($categoria == 'Todos') {

    $sql = "SELECT * FROM produtos";

} else {

    $sql = "SELECT * FROM produtos WHERE categoria = ?";

}

if ($categoria != 'Mais Vendidos' && $categoria != 'Todos') {

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoria);
    $stmt->execute();

    $resultado = $stmt->get_result();

} else {

    $resultado = $conn->query($sql);

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LEWIS | Loja</title>

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <?php require "./view/header.php"; ?>

    <main>

        <section class="banner">
            <img src="./img/banner.jpg" alt="Coleção LEWIS">
        </section>
        <nav class="categorias">

            <a href="index.php?categoria=Mais Vendidos">
                Mais Vendidos
            </a>

            <a href="index.php?categoria=Todos">
                Todos
            </a>

            <a href="index.php?categoria=Feminino">
                Feminino
            </a>

            <a href="index.php?categoria=Masculino">
                Masculino
            </a>

        </nav>

        <section class="produtos">

            <?php while ($produto = $resultado->fetch_object()) { ?>

                <div class="produto">

                    <a href="produto.php?id=<?php echo $produto->id; ?>">

                        <img
                            src="<?php echo htmlspecialchars($produto->imagem); ?>"
                            alt="<?php echo htmlspecialchars($produto->nome); ?>"
                        >

                    </a>

                    <p class="nome">
                        <?php echo htmlspecialchars($produto->nome); ?>
                    </p>

                    <p class="categoria">
                        <?php echo htmlspecialchars($produto->categoria); ?>
                    </p>

                    <div class="preco">

                        <span>
                            R$ <?php echo number_format($produto->preco, 2, ',', '.'); ?>
                        </span>

                        <span class="coracao">♡</span>

                    </div>

                </div>

            <?php } ?>

        </section>

        <div class="ver-mais">
            <a href="index.php?categoria=Todos">
                Ver mais ⊕
            </a>
        </div>

    </main>

    <?php require "./view/footer.php"; ?>

</body>
</html>
