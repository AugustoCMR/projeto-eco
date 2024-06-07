<h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Novo Usuário</h1>

<form method="POST" action="../user/register_user_success" class="mt-5">
    
    <div class="mb-3">
        <label class="font-weight-bold" style=" margin: 0% 22%;">Nome</label>
        <input type="text" style="width:700px; margin: 0% 22%;" name="nome" class="form-control">
    </div>
   
    <label class="font-weight-bold" style=" margin: 0% 22%;">Sobrenome</label>
    <div class="mb-3">
    <input type="text" style="width:700px; margin: 0% 22%;" name="sobrenome" class="form-control">
    </div>

    <label class="font-weight-bold" style=" margin: 0% 22%;">Email</label>
    <div class="mb-3">
    <input type="text" style="width:700px; margin: 0% 22%;" name="email" class="form-control">
    </div>

    <label class="font-weight-bold" style=" margin: 0% 22%;">CPF</label>
    <div class="mb-3">
    <input type="text" style="width:700px; margin: 0% 22%;" name="cpf" class="form-control">
    </div>

    <label class="font-weight-bold" style=" margin: 0% 22%;">CEP</label>
    <div class="mb-3">
    <input type="text" style="width:700px; margin: 0% 22%;" name="cep" class="form-control">
    </div>

    <label class="font-weight-bold" style=" margin: 0% 22%;">Rua</label>
    <div class="mb-3">
        <input type="text" style="width:700px; margin: 0% 22%;" name="rua" class="form-control">
    </div>

    <label class="font-weight-bold" style=" margin: 0% 22%;">Bairro</label>
    <div class="mb-3">
        <input type="text" style="width:700px; margin: 0% 22%;" name="Bairro" class="form-control">
    </div>

    <label class="font-weight-bold" style=" margin: 0% 22%;">Número</label>
    <div class="mb-3">
        <input type="text" style="width:700px; margin: 0% 22%;" name="numero" class="form-control">
    </div>

    <div class="mb-3">
        <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastro_usuario"  value="cadastro_usuario" style=" margin: 1% 22%;width:700px;">Enviar</button>
    </div>
</form>