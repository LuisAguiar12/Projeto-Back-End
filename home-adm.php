<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="./css/header-adm.css">
    <link rel="stylesheet" href="./css/menu-lateral.css">
    <link rel="stylesheet" href="./css/tela-inicial.css">
</head>
<body>
    <?php include 'view/header-adm.php';?>
    <?php include 'view/menu-lateral.php';?>
   <main class="dashboard-content">

    <!-- Saudação -->
    <section class="welcome">
        <h1>Olá, <span>Maria!</span></h1>
        <p>Aqui está um resumo da sua loja.</p>
    </section>

    <!-- Cards de informações -->
    <section class="dashboard-cards">

        <div class="info-card">
            <span>VENDAS TOTAIS</span>
            <h2>R$ 5000,00</h2>
        </div>

        <div class="info-card">
            <span>CLIENTES</span>
            <h2>500</h2>
        </div>

        <div class="info-card">
            <span>PEDIDOS</span>
            <h2>100</h2>
        </div>

        <div class="info-card">
            <span>PRODUTOS VENDIDOS</span>
            <h2>1000</h2>
        </div>

    </section>

    <!-- Tabelas do dashboard -->
    <section class="dashboard-tables">

        <!-- Clientes mais frequentes -->
        <div class="dashboard-table">

            <div class="table-header">
                <h3>Clientes mais frequentes</h3>
            </div>

            <div class="table-content">
                <table>
                    <thead>
                        <tr>
                            <th>POS.</th>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>COMPRAS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>300</td>
                            <td>Júlio Alberto Costa</td>
                            <td>22</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Produtos mais recentes -->
        <div class="dashboard-table">

            <div class="table-header">
                <h3>Produtos mais recentes</h3>
            </div>

            <div class="table-content">
                <table>
                    <thead>
                        <tr>
                            <th>Class.</th>
                            <th>ID</th>
                            <th>Nome</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>12</td>
                            <td>Bolsa TT</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </section>

</main>

</body>
</html>