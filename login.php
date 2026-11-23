
<?php
    session_start();
    require "./data/conexao.php";
    $mensagem_erro = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email = trim($_POST["email"]);
        $senha = trim($_POST["senha"]);

        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";

        $stmt = $conn->prepare($sql);
        $stmt ->bind_param("ss", $email, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_object();
        if($usuario){
            $_SESSION["usuario_id"] = $usuario ->id;
            $_SESSION["usuario_nome"] = $usuario ->nome;
            $_SESSION["tipo_usuário"] = $usuario ->tipo;

            header("Location: /produtos.php");
            exit;
            }
            else{
            $mensagem_erro = "Credencais Invalidas";
        };
    };

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <main class="container-login">
        <a href="home.php"><img src="image/icon-back.png" alt="" class="back"></a>

        <!-- LADO ESQUERDO -->
        <section class="lado-esquerdo">
            <div class="logo">
                <img src="image/LogoLogin.png" alt="">
            </div>
        </section>


        <!-- LADO DIREITO -->
        <section class="lado-direito">


            <form class="formulario">

                <!-- CAMPO EMAIL -->
                <div class="grupo-input">
                    <label for="email">E-mail</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="SeuEmail@gmail.com">
                </div>

                <!-- CAMPO SENHA -->
                <div class="grupo-input">
                    <label for="senha">Senha</label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Sua senha">
                </div>

                <!-- ESQUECEU A SENHA -->
                <div class="esqueceu-senha">
                    <a href="#">Esqueceu sua senha?</a>
                </div>

                <!-- BOTÃO ENTRAR -->
                <button type="submit" class="btn-entrar">
<<<<<<< HEAD
                    Entrar
=======
                    <a href="index.php">ssssss</a>Entrar
>>>>>>> 7116ede3ff1994b3e04c18ba68f3120f0203c249
                </button>

                <!-- CADASTRO -->
                <div class="cadastro">
                    <p>
                        Não possui uma conta?
                        <a href="cadastrar.php">Cadastrar-se.</a>
                    </p>
                </div>

            </form>


        </section>

    </main>

</body>

</html>