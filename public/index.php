<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Planeta Eco</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
  </head>


  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-ligth">
        <a class="navbar-brand" href="/projeto-eco/public/home/index"><button class="btn btn-light"><img src="./img/veiculo.png" alt=""></button>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                
                <div class="dropdown mr-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuário
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/usuario/cadastrar">Cadastrar usuário</a>
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/user/consultar_materiais_entregues">Consulta Materiais Entregues</a>
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/user/extrato">Extrato</a>
                    </div>
                </div>

                <div class="dropdown mr-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Material
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="nav-item nav-link font-weight-bold" href="/projeto-eco/public/material/cadastrarResiduo">Cadastrar Tipo de Resíduo</a>
                        <a class="nav-item nav-link font-weight-bold" href="/projeto-eco/public/material/cadastrarMaterial">Cadastrar Material</a>
                        <a class="nav-item nav-link font-weight-bold" href="/projeto-eco/public/material/cadastrarMaterialRecebido">Cadastrar Recebimento de Material</a>
                    </div>
                </div>

                <div class="dropdown mr-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Produto
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/produto/cadastrar_produto">Cadastrar Produto</a>
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/produto/cadastrar_operacao_entrada_produto">Operação de Entrada</a>
                        <a class="nav-item nav-link text-nowrap font-weight-bold" href="/projeto-eco/public/produto/cadastrar_operacao_saida_produto">Operação de Saída</a>
                        <a class="nav-item nav-link text-nowrap font-weight-bold" href="/projeto-eco/public/produto/consultar_produto">Consultar produto</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
  
 
  <?php
    require '../Application/autoload.php';

    use Application\core\App;
    use Application\core\Controller;

    $app = new App();

  ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    
  </body>
</html>