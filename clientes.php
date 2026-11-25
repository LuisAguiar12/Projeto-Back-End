<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Clientes</title>
    <link rel="stylesheet" href="./css/menu-lateral.css">
    <link rel="stylesheet" href="./css/header-adm.css">
    <link rel="stylesheet" href="./css/clientes.css">
</head>
<body>
    <?php include 'view/header-adm.php';?>
    <?php include 'view/menu-lateral.php';?>
    <div class="conteudo">
    <section>
        <div class="titulo">
         <h1>Clientes<img src="./image/Clientes-tela.svg" alt=""></h1>
        

    <div class="filtro">
     <div><h1><span><svg aria-hidden="true" data-prefix="far" data-icon="filter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-filter fa-w-16 fa-7x"><path fill="currentColor" d="M463.952 0H48.057C5.419 0-16.094 51.731 14.116 81.941L176 243.882V416c0 15.108 7.113 29.335 19.2 40l64 47.066c31.273 21.855 76.8 1.538 76.8-38.4V243.882L497.893 81.941C528.042 51.792 506.675 0 463.952 0zM288 224v240l-64-48V224L48 48h416L288 224z" class=""></path></svg></span>Filtro </h1></div>
    </div>
        </div>
        <main> 
             <div class="container">
    
            <div class="tabela-container">
    
                <table class="tabela">
    
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Compras</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
    
                    <tbody>
    
                        <tr data-status="entregue">
                            <td>1</td>
                            <td class="cliente">Jonas Marcos</td>
                            <td class="data">jonasmarcos@email.com</td>
                            <td>(11) 99999-9999</td>
                            <td class="preco">20</td>
                            <td><button class="acao">•••</button></td>
                        </tr>
                        <tr data-status="entregue">
                            <td>1</td>
                            <td class="cliente">Jonas Marcos</td>
                            <td class="data">jonasmarcos@email.com</td>
                            <td>(11) 99999-9999</td>
                            <td class="preco">20</td>
                            <td><button class="acao">•••</button></td>
                        </tr>
                        
                    </main>
    </section>
</div>
</body>
</html>