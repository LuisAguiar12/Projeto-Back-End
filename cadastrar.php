<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="css/cadastrar.css">
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

                <!-- BOTÃO ENTRAR -->
                <button type="submit" class="btn-entrar">
                    Cadastrar-se
                </button>

                <!-- CADASTRO -->
                <div class="cadastro">
                    <p>
                        Já possui uma conta?
                        <a href="login.php">Login.</a>
                    </p>
                </div>

            </form>


        </section>

    </main>

</body>

</html>