<h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Recebimento de Material</h1>

<form method="POST" action="../material/cadastro_recebimento_material_sucesso">
    
    <div class="mb-3">
        <label class="font-weight-bold">Usuário</label>
        <input type="text" name="usuario" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold">Material</label>
        <input type="text" name="material" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold">Quantidade</label>
        <input type="text" name="quantidade" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold">Eco Points</label>
        <input type="text" name="eco_valor" class="form-control">
    </div>

    <div class="mb-3">
        <button type="submit" class= "btn btn-primary font-weight-bold" name="dados-categoria"  value="cadastrar-categoria">Enviar</button>
    </div>
</form>