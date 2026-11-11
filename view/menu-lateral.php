<?php
$basePath = "/";

$paginaAtual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $basePath ?>css/header-adm.css">
</head>

<body>
    <div class="header">

        <div class="img-header">
            <img src="<?= $basePath ?>image/Logo.svg" alt="Logo">
        </div>

        <div class="telas-adm">

            <a class="telas <?= $paginaAtual === 'index.php' ? 'ativo' : '' ?>" href="<?= $basePath ?>">
                <img src="<?= $basePath ?>image/Inicio.svg" alt="Início">
                <h1>Início</h1>
            </a>

            <a class="telas <?= $paginaAtual === 'pedidos.php' ? 'ativo' : '' ?>" href="<?= $basePath ?>pedidos.php">
                <img src="<?= $basePath ?>image/Pedidos.svg" alt="Pedidos">
                <h1>Pedidos</h1>
            </a>

            <a class="telas <?= $paginaAtual === 'produtos.php' ? 'ativo' : '' ?>" href="<?= $basePath ?>produtos.php">
                <img src="<?= $basePath ?>image/Produtos.svg" alt="Produtos">
                <h1>Produtos</h1>
            </a>

            <a class="telas <?= $paginaAtual === 'clientes.php' ? 'ativo' : '' ?>" href="<?= $basePath ?>clientes.php">
                <img src="<?= $basePath ?>image/Clientes.svg" alt="Clientes">
                <h1>Clientes</h1>
            </a>

            <a class="telas <?= $paginaAtual === 'estoque.php' ? 'ativo' : '' ?>" href="<?= $basePath ?>estoque.php">
                <img src="<?= $basePath ?>image/Estoque.svg" alt="Estoque">
                <h1>Estoque</h1>
            </a>

        </div>

        <div class="sair">
            <img src="<?= $basePath ?>image/Sair.svg" alt="Sair">
            <h1>Sair</h1>
        </div>

    </div>
</body>