<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display 4 text-center text-primary">Novo Material</h1>
        <?php
      
        if (!empty($data['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($data['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../material/register_material" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold">Nome</label>
                <input type="text" name="nome"  class="form-control">
            </div>

            <div class="mb-3">
                <label class="font-weight-bold" >Unidade de Medida</label>
                <select class="form-control" name="unidade_medida_id" id="">
                    <option value="">Selecione uma opção</option>
                    <option value="kg">Quilograma(kg)</option>
                    <option value="unidade">Unidade</option>          
                </select>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold" >Eco Points</label>
                <input type="text" name="eco_valor" class="form-control">
            </div>

            <div class="mb-3">
                <label class="font-weight-bold" >Tipo de Resíduo</label>
                
                    <select type="number" name="tipo_residuo" id="categoria" class="form-control"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                       
                        if(isset($data['tipo_residuos']))
                        { 
                            
                            foreach($data['tipo_residuos'] as $residuos)
                            { ?>
                            <option value="<?=$residuos['id'] ?>" > <?= $residuos['name'] ?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                    </select>
            </div>

            <div class="mb-1">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrar_material"  value="cadastrar-categoria">Enviar</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</main>