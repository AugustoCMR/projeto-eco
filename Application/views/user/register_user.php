<h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Novo Usuário</h1>

<form method="POST" action="../user/register_user_success">
    
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
        <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastro_usuario"  value="cadastro_usuario">Enviar</button>
    </div>
</form>