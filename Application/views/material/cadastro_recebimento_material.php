<h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Recebimento de Material</h1>

<form method="POST" action="../material/cadastro_recebimento_material_sucesso" class="mt-5">
    
    <div class="mb-3">
        <label class="font-weight-bold" style="margin: 0% 22%">Usuário</label>
        <input type="text" name="usuario" style="width:700px; margin: 0% 22%;" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold" style="margin: 0% 22%">Material</label>
        <input type="text" name="material" style="width:700px; margin: 0% 22%;" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold" style="margin: 0% 22%">Quantidade</label>
        <input type="text" name="quantidade" style="width:700px; margin: 0% 22%;" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold" style="margin: 0% 22%">Eco Points</label>
        <input type="text" name="eco_valor" style="width:700px; margin: 0% 22%;" class="form-control">
    </div>

    <div class="mb-3">
        <button type="submit" class= "btn btn-primary font-weight-bold" name="dados-categoria" style="width:700px; margin: 0% 22%;" value="cadastrar-categoria">Enviar</button>
    </div>
</form>