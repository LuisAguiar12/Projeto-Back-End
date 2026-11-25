<?php
require __DIR__ . "/conexao.php";
$sql = "select * from clientes";
$resultado = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/logica.css">
    <title>Gerenciamento de Clientes</title>

</head>

<body>

    <div class="container">

        <div class="topo">
            <h1>Gerenciamento de Clientes</h1>

            <button class="btn-adicionar">
                + Adicionar Cliente
            </button>
        </div>

        <div class="clientes">

        <?php while ($usuario = $resultado->fetch_object()): ?>

            <div class="cliente">

                <div class="cliente-topo">
                    <h2><?= $usuario -> nome ?></h2>
                    <span class="status admin"><?= $usuario -> tipo_usuário ?></span>
                </div>

                <div class="informacao">
                    <label>ID</label>
                    <p><?= $usuario -> id_cliente ?></p>
                </div>

                <div class="informacao">
                    <label>E-mail</label>
                    <p><?= $usuario -> email ?></p>
                </div>

                <div class="informacao">
                    <label>Senha</label>
                    <p><?= $usuario -> senha ?></p>
                </div>

                <div class="informacao">
                    <label>Telefone</label>
                    <p><?= $usuario -> telefone ?></p>
                </div>

                <div class="informacao">
                    <label>Administrador?</label>
                    <p>Sim</p>
                </div>

                <div class="acoes">
                    <a href="logica-editar.php?id=<?= $usuario -> id_cliente ?>"><button class="editar">Editar</button></a>
                    <button class="excluir">Excluir</button>
                </div>

            </div>

        <?php endwhile; ?>

        </div>

    </div>

</body>
</html>