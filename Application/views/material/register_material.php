

<h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Novo Resíduo</h1>

<form method="POST" action="../material/register_material_success" class="mt-5">
    
    <div class="mb-3">
        <label class="font-weight-bold" style="margin: 0% 22%;">Nome</label>
        <input type="text" name="name" style="width:700px; margin: 0% 22%;" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold" style="margin: 0% 22%;">Unidade de Medida</label>
        <input type="text" name="unidade_medida" style="width:700px; margin: 0% 22%;" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold" style="margin: 0% 22%;">Eco Points</label>
        <input type="text" name="eco_valor" style="width:700px; margin: 0% 22%;" class="form-control">
    </div>

    <div class="mb-3">
        <label class="font-weight-bold" style="margin: 0% 22%;">Tipo de Resíduo</label>
        <input type="text" name="tipo_residuo_id" style="width:700px; margin: 0% 22%;" class="form-control">
    </div>

    <div class="mb-3">
        <button type="submit" class= "btn btn-primary font-weight-bold" style="width:700px; margin: 0% 22%;"name="dados-categoria"  value="cadastrar-categoria">Enviar</button>
    </div>
</form>