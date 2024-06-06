<nav class="navbar navbar-expand-lg navbar-light bg-ligth">
        <a class="navbar-brand" href="../home/index"><button class="btn btn-light"><img src="./img/veiculo.png" alt=""></button>
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
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="">Cadastrar usuário</a>
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="?page=listar-categorias">Lista de Categorias</a>
                    </div>
                </div>

                <div class="dropdown mr-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Veiculo
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="nav-item nav-link font-weight-bold" href="?page=cadastrar-veiculo">Cadastrar Veículo</a>
                        <a class="nav-item nav-link font-weight-bold" href="?page=listar-veiculos">Lista de Veículos</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Registro
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="nav-item nav-link font-weight-bold text-nowrap" href="?page=cadastrar-registro">Cadastrar Registro</a>
                        <a class="nav-item nav-link   text-nowrap font-weight-bold" href="?page=listar-registros">Lista de Registros</a>
                    </div>
                </div>
            </div>
        </div>
</nav>

<h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Novo Usuário</h1>

<form method="POST" action="../user/register_user">
    
    <div class="mb-3">
        <label class="font-weight-bold">Nome</label>
        <input type="text" name="nome" class="form-control">
    </div>
   
    <label class="font-weight-bold">Sobrenome</label>
    <div class="mb-3">
        <input type="text" name="sobrenome" class="form-control">
    </div>

    <label class="font-weight-bold">Email</label>
    <div class="mb-3">
        <input type="text" name="email" class="form-control">
    </div>

    <label class="font-weight-bold">CPF</label>
    <div class="mb-3">
        <input type="text" name="cpf" class="form-control">
    </div>

    <label class="font-weight-bold">CEP</label>
    <div class="mb-3">
        <input type="text" name="cep" class="form-control">
    </div>

    <label class="font-weight-bold">Rua</label>
    <div class="mb-3">
        <input type="text" name="rua" class="form-control">
    </div>

    <label class="font-weight-bold">Bairro</label>
    <div class="mb-3">
        <input type="text" name="Bairro" class="form-control">
    </div>

    <label class="font-weight-bold">Número</label>
    <div class="mb-3">
        <input type="text" name="numero" class="form-control">
    </div>

    <div class="mb-3">
        <button type="submit" class= "btn btn-primary font-weight-bold" name="dados-categoria"  value="cadastrar-categoria">Enviar</button>
    </div>
</form>