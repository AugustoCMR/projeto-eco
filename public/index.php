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
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/user/register_user">Cadastrar usuário</a>
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="?page=listar-categorias">Lista de Categorias</a>
                    </div>
                </div>

                <div class="dropdown mr-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Material
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="nav-item nav-link font-weight-bold" href="/projeto-eco/public/material/register_type_residue">Cadastrar Tipo de Resíduo</a>
                        <a class="nav-item nav-link font-weight-bold" href="/projeto-eco/public/material/register_material">Cadastrar Material</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Operações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="/projeto-eco/public/operacao/operacao_entrada">Operação de Entrada</a>
                        <a class="nav-item nav-link text-nowrap font-weight-bold" href="/projeto-eco/public/operacao/operacao_saida">Operação de Saída</a>
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