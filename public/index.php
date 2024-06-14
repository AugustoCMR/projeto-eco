<!DOCTYPE html>
<html lang="pt-br">
     <head>
        <meta charset="utf-8">
        <title>Planeta Eco</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="../../public/assets/css/style.css">
     </head>


    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-primary">

                <a class="navbar-brand" href="/projeto-eco/public/home/index"><button class="btn btn-light"><img src="../../public/assets/img/icone.png" alt=""></button>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <div class="dropdown mr-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Usuário
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/usuario/cadastrar">Cadastrar usuário</a>
                                <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/usuario/consultarMateriaisEntregues">Consulta Materiais Entregues</a>
                                <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/usuario/extrato">Extrato</a>
                                <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/usuario/consultarUsuarios">Consultar Usuários</a>
                            </div>
                        </div>

                        <div class="dropdown mr-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Material
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="nav-item nav-link font-weight-bold" href="/projeto-eco/public/material/cadastrarResiduo">Cadastrar Tipo de Resíduo</a>
                                <a class="nav-item nav-link font-weight-bold" href="/projeto-eco/public/material/cadastrarMaterial">Cadastrar Material</a>
                                <a class="nav-item nav-link font-weight-bold" href="/projeto-eco/public/material/cadastrarMaterialRecebido">Cadastrar Recebimento de Material</a>
                                <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/material/consultarMateriais">Consultar Materiais</a>
                            </div>
                        </div>

                        <div class="dropdown mr-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Produto
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/produto/cadastrar">Cadastrar Produto</a>
                                <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/produto/cadastrarProdutoEntregue">Operação Entrada de Produto</a>
                                <a class="nav-item nav-link text-nowrap font-weight-bold" href="/projeto-eco/public/produto/cadastrarProdutoSaida">Operação de Saída</a>
                                <a class="nav-item nav-link text-nowrap font-weight-bold" href="/projeto-eco/public/produto/consultarProdutos">Consultar produto</a>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="navbar-title text-light mx-auto titulo">Planeta Eco</h1>
        </nav>
        
    </header>

    <?php
    require '../Application/autoload.php';

    use Application\core\App;
    use Application\core\Controller;
    
    $app = new App();
    
    ?>
    <div class="font-weight-bold">
     <footer class="py-3 d-flex align-items-center footer">
            <a href="https://github.com/AfonsoFerroNunes" target="_blank"><i class="fab fa-github" style="color: #ffffff;"></i></a>
            <p>Afonso Ferro</p>
            <a href="https://github.com/AugustoCMR" target="_blank"><i class="fab fa-github" style="color: #ffffff;"></i></a>
            <p>Augusto Ribeiro</p>
        </footer>
    </div>
      
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    </body>
</html>