
<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Consultar Produto</h1>
        


        <form method="POST" action="../material/register_material_success" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold" style="">Usuario</label>
                <input type="text" style="" name="name"    
                value="<?= isset($data['name']) ? $data['name'] : '' ?>" class="form-control" placeholder="Nome do Usuario">
            </div>

            <label class="font-weight-bold" style="">Materiais Entregues</label>
            <div class="mb-3">
            <input type="text" style="" name="unidade_medida"
            value="<?= isset($data['unidade_medida']) ? $data['unidade_medida'] : '' ?>" class="form-control" placeholder="Materiais Entregues">
            </div>
        
           


            <label class="font-weight-bold" style="">Valor</label>
            <div class="mb-3">
            <input type="text" style="" name="tipo_residuo_id"
            value="<?= isset($data['tipo_residuo_id']) ? $data['tipo_residuo_id'] : '' ?>" class="form-control" placeholder="Valor">
            </div>


            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="dados-categoria"  value="cadastrar-categoria">Enviar</button>
        </div>

           
        </form>
        
      </div>
    </div>
  </div>
</main>