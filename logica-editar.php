<?php

require "data/conexao.php";

$id = $_GET["id"] ?? 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if ($nome === "" || $senha === "" || $email === "") {
        $mensagem_erro = "preencha todos os campos";
    } else {
        $sql = "UPDATE clientes SET nome = '$nome', senha = '$senha', email = '$email' WHERE id_cliente=$id";
        $conn->query($sql);
    }
}

$sql = "SELECT * FROM clientes WHERE id_cliente =$id";
$resultado = $conn->query($sql);
$usuario = $resultado->fetch_object();

if (!$usuario) {
    die("Usuário não encontrado!");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/logica-editar.css">
    <title>Editar Usuario</title>
</head>

<body>
      <a href="logica.php" class="a"><svg aria-hidden="true" data-prefix="far" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8 fa-7x"><path fill="currentColor" d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z" class=""></path></svg></a>  
    <form method="POST">
        <label for="nome">nome</label>
        <input type="text" name="nome" id="nome" value="<?= $usuario->nome ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $usuario->email ?>" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" value="<?= $usuario->senha ?>" required>

        <button type="submit">Editar</button>
        <a href="exclui-usuario.php?id=<?php echo $usuario->id_cliente; ?>">Excluir</a>
    </form>
</body>

</html>