

<h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Novo Resíduo</h1>

<form method="POST" action="../material/register_material_success">
    
    <div class="mb-3">
        <label class="font-weight-bold">Nome</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold">Unidade de Medida</label>
        <input type="text" name="unidade_medida" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold">Eco Points</label>
        <input type="text" name="eco_valor" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold">Tipo de Resíduo</label>
        <input type="text" name="tipo_residuo_id" class="form-control">
    </div>

    <div class="mb-3">
        <button type="submit" class= "btn btn-primary font-weight-bold" name="dados-categoria"  value="cadastrar-categoria">Enviar</button>
    </div>
</form>