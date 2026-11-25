<?php
require "data/conexao.php";
$sql = "SELECT
    produtos.id_produto,
    produtos.nome,
    produtos.preco,
    categorias.nome AS categoria,
    generos.nome AS genero,
    SUM(estoque.quantidade) AS estoque_total
FROM produtos
INNER JOIN categorias
    ON produtos.id_categoria = categorias.id_categoria
INNER JOIN generos
    ON produtos.id_genero = generos.id_genero
INNER JOIN estoque
    ON produtos.id_produto = estoque.id_produto
GROUP BY
    produtos.id_produto,
    produtos.nome,
    categorias.nome,
    generos.nome;";
$resultado = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="./css/menu-lateral.css">
    <link rel="stylesheet" href="./css/pedidos.css">
    <link rel="stylesheet" href="./css/produtos.css">
    <link rel="stylesheet" href="css/modal-produto.css">
</head>

<body>
    <?php
    include 'view/menu-lateral.php';
    ?>
    <?php
    include 'view/header-adm.php';
    ?>

    <main>
        <div class="container">

            <div class="titulo">
                <h1>Produtos</h1>
                <img src="./image/bolsa-produtos.png" alt="" class="imagemTitulo">
            </div>

            <!-- ABAS -->

            <div class="filtros">

                <!-- FILTRO DE CATEGORIAS -->
                <div class="filtro-container">
                    <select name="categoria" id="categoria">
                        <option value="">Todas as Categorias</option>
                        <option value="blazer">Blazer</option>
                        <option value="calca">Calça</option>
                        <option value="terno">Terno</option>
                        <option value="blusa">Blusa</option>
                    </select>
                </div>

                <!-- FILTRO DE GÊNEROS -->
                <div class="filtro-container">
                    <select name="genero" id="genero">
                        <option value="">Todos os gêneros</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="unisex">Unisex</option>
                    </select>
                </div>

                <!-- FILTRO DE STATUS -->
                <div class="filtro-container">
                    <select name="status" id="status">
                        <option value="">Todos os status</option>
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                </div>

                <!-- FILTRO DE STATUS -->

                <div class="">
                    <a href="adicionar-produto.php" class="btn-adicionar">
                        <span class="icone-mais">+</span>
                        <span>Adicionar produto</span>
                    </a>
                </div>
            </div>


            <!-- TABELA -->
            <div class="tabela-container">

                <table class="tabela">

                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Genero</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($produto = $resultado->fetch_object()): ?>

                            <tr data-status="entregue">
                                <td><img src="<?= $produto -> nome ?>" alt="" class="imgTable"></td>
                                <td class="cliente"><?= $produto -> nome ?></td>
                                <td class="data"><?= $produto -> categoria ?></td>
                                <td class="data"><?= $produto -> genero ?></td>
                                <td class="data"><?= $produto -> preco ?></td>
                                <td class="data"><?= $produto -> estoque_total ?></td>
                                <td><span class="status entregue">ativo</span></td>
                                <td><button class="acao" type="button" class="btn-acao" onclick="abrirModal()">•••</button></td>
                            </tr>

                        <?php endwhile; ?>
    </main>

    <!-- MODAL -->
    <div class="modal-overlay" id="modalProduto">

        <div class="modal-container">

            <!-- LADO ESQUERDO: IMAGENS -->
            <div class="modal-imagens">

                <div class="imagem-principal">
                    <img src="image/produto.png" alt="Imagem do produto">
                </div>

                <div class="miniaturas">
                    <img src="image/produto.png" alt="Miniatura 1">
                    <img src="image/produto2.png" alt="Miniatura 2">
                    <img src="image/produto3.png" alt="Miniatura 3">
                </div>

            </div>

            <!-- LADO DIREITO: INFORMAÇÕES -->
            <div class="modal-informacoes">

                <h2>Nome do produto</h2>

                <h1 class="preco">R$ 500,00</h1>

                <h3>Estoque: 30</h3>

                <hr>

                <div class="detalhes-produto">
                    <p>Descrição: Descrição breve do produto...</p>
                    <p>Categoria: Calças</p>
                    <p>Gênero: Feminino</p>
                    <p>Status: Ativo</p>
                </div>

                <!-- BOTÕES -->
                <div class="modal-botoes">

                    <button class="btn-voltar" onclick="fecharModal()">
                        <img src="./image/Sair.svg" alt=""> Voltar
                    </button>

                    <a href="editar-produto.php?id=1" class="btn-editar">
                        <img src="./image/Editar.png" alt=""> Editar
                    </a>

                    <a href="excluir-produto.php?id=1"
                        class="btn-excluir"
                        onclick="return confirm('Deseja realmente excluir este produto?')">
                        <img src="./image/Excluir.png" alt=""> Excluir
                    </a>

                </div>

            </div>

        </div>

    </div>
    <script src="./js/produtos.js"></script>
</body>

</html>