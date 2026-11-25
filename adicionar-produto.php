<?php
require "./data/auth.php";

$mensagem_erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if ($nome == '' || $email == '' || $senha == '') {
        $mensagem_erro = 'Preencha todos os campos';
    } else {
        $sql = "INSERT INTO usuarios
        (nome, email, senha)
        VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha);

        try {
            $stmt->execute();
            exit;
        } catch (mysqli_sql_exception $e) {
            $mensagem_erro = $e->getCode() === 1062
                ? "Email ja Cadastrado"
                : 'Erro ao cadastrar';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto</title>

    <!-- CSS do  e cabeçalho já existentes -->
    <link rel="stylesheet" href="./css/menu-lateral.css">
    <link rel="stylesheet" href="./css/header.css">

    <!-- CSS da página -->
    <link rel="stylesheet" href="./css/editar-produto.css">
</head>

<body>

    <?php include 'view/menu-lateral.php'; ?>

    <?php include 'view/header-adm.php'; ?>

    <main class="pagina-editar">

        <div class="container-editar">

            <!-- TÍTULO -->
            <div class="titulo-editar">
                <h1>Editar produto</h1>
                <img src="./image/bolsa-produtos.png" alt="Produtos">
            </div>

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="conteudo-editar">

                    <!-- COLUNA ESQUERDA -->
                    <div class="coluna-esquerda">

                        <!-- ÁREA DE IMAGEM -->
                        <label for="imagens" class="area-imagem">

                            <input
                                type="file"
                                name="imagens[]"
                                id="imagens"
                                accept=".jpeg,.jpg,.png,.svg"
                                multiple>

                            <svg viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 4h-4l-1.5 2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-3.5L14 4Z" />
                                <circle cx="12" cy="13" r="4" />
                            </svg>

                            <span class="texto-imagem">
                                Arraste as imagens aqui ou<br>
                                clique para selecionar
                            </span>

                            <span class="formato-imagem">
                                Formato: JPEG, PNG ou SVG
                            </span>

                        </label>

                        <!-- DESCRIÇÃO -->
                        <div class="campo-descricao">

                            <label for="descricao">Descrição</label>

                            <textarea
                                name="descricao"
                                id="descricao"
                                placeholder="Descreva o produto..."></textarea>

                        </div>

                    </div>

                    <!-- COLUNA DIREITA -->
                    <div class="coluna-direita">

                        <div class="campo">
                            <label for="nome">Nome do produto</label>
                            <input type="text" name="nome" id="nome">
                        </div>

                        <div class="campo">
                            <label for="categoria">Categoria do produto</label>

                            <select name="categoria" id="categoria">
                                <option value=""></option>
                                <option value="1">Blazer</option>
                                <option value="2">Calça</option>
                                <option value="3">Terno</option>
                                <option value="4">Blusa</option>
                            </select>
                        </div>

                        <div class="campo">
                            <label for="genero">Gênero do produto</label>

                            <select name="genero" id="genero">
                                <option value=""></option>
                                <option value="1">Masculino</option>
                                <option value="2">Feminino</option>
                                <option value="3">Unisex</option>
                            </select>
                        </div>

                        <div class="campo">
                            <label for="tamanho">Tamanho do produto</label>

                            <select name="tamanho" id="tamanho">
                                <option value=""></option>
                                <option value="P">P</option>
                                <option value="M">M</option>
                                <option value="G">G</option>
                                <option value="GG">GG</option>
                            </select>
                        </div>

                        <!-- PREÇO E ESTOQUE -->
                        <div class="campos-duplos">

                            <div class="campo">
                                <label for="preco">Preço</label>
                                <input type="number" name="preco"
                                    id="preco" step="0.01">
                            </div>

                            <div class="campo">
                                <label for="estoque">Estoque</label>
                                <input type="number" name="estoque"
                                    id="estoque">
                            </div>

                        </div>

                        <!-- STATUS -->
                        <div class="campo-status">

                            <span>Status:</span>

                            <div class="opcoes-status">

                                <label>
                                    <input type="radio" name="status"
                                        value="Ativo">
                                    Ativo
                                </label>

                                <label>
                                    <input type="radio" name="status"
                                        value="Inativo">
                                    Inativo
                                </label>

                            </div>

                        </div>

                        <!-- BOTÕES -->
                        <div class="botoes-editar">

                            <a href="produtos.php" class="btn-cancelar">
                                Cancelar
                            </a>

                            <button type="submit" class="btn-salvar">
                                Salvar produto
                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </main>

</body>

</html>