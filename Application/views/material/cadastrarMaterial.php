<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:50px">
        <h1 class="display 4 text-center text-primary mt-5 titulo">Novo Material</h1>
        <?php
      
        if (!empty($dados['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../material/cadastrarMaterial" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold">Material</label>
                <input type="text" name="nm_material"  class="form-control">
            </div>

            <div class="mb-3">
                <label class="font-weight-bold" >Unidade de Medida</label>
                <select class="form-control" name="nm_unidademedida" id="">
                    <option value="">Selecione uma opção</option>
                    <option value="kg">Quilograma(kg)</option>
                    <option value="unidade">Unidade</option>          
                </select>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold" >Eco Points</label>
                <input type="text" name="vl_eco" class="form-control">
            </div>

            <div class="mb-3">
                <label class="font-weight-bold" >Tipo de Resíduo</label>
                
                    <select type="number" name="idResiduo" id="categoria" class="form-control"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                       
                        if(isset($dados['residuos']))
                        { 
                            
                            foreach($dados['residuos'] as $residuos)
                            { ?>
                            <option value="<?=$residuos['id_residuo'] ?>" > <?= $residuos['nm_residuo'] ?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                    </select>
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrarMaterial"  value="cadastrar-categoria">Enviar</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</main>