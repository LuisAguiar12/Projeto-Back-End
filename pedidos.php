<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="./css/menu-lateral.css">
    <link rel="stylesheet" href="./css/pedidos.css">
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
            <span></span>
        </div>

        <!-- ABAS -->
        <div class="abas">

            <button class="aba ativa" onclick="filtrar('todos', this)">
                Todos (5)
            </button>

            <button class="aba" onclick="filtrar('pago', this)">
                Pago (1)
            </button>

            <button class="aba" onclick="filtrar('separacao', this)">
                Em separação (1)
            </button>

            <button class="aba" onclick="filtrar('enviado', this)">
                Enviado (1)
            </button>

            <button class="aba" onclick="filtrar('entregue', this)">
                Entregue (2)
            </button>

        </div>

        <!-- TABELA -->
        <div class="tabela-container">

            <table class="tabela">

                <thead>
                    <tr>
                        <th>Nº do pedido</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Preço</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody>

                    <tr data-status="entregue">
                        <td>#1</td>
                        <td class="cliente">Blazer Alfaiataria</td>
                        <td class="data">11/22/2026</td>
                        <td><span class="status entregue">Entregue</span></td>
                        <td class="preco">R$599,90</td>
                        <td><button class="acao">•••</button></td>
                    </tr>
                </main>
</body>
</html>