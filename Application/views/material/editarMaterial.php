<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:50px">
        <h1 class="display 4 text-center text-primary mt-5 titulo">Atualizar Material</h1>
        <?php
      
        if (!empty($dados['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php $material = $dados['material'][0]?>
        <form method="POST" action="/projeto-eco/public/material/editarMaterial" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold">Material</label>
                <input type="text" name="nm_material" class="form-control" value="<?= ucfirst($material['nm_material'])?>">
            </div>

            <div class="mb-3">
                <label class="font-weight-bold" >Unidade de Medida</label>
                <select class="form-control" name="nm_unidademedida" id="" value="<?= $material['nm_unidademedida']?>">
                    <option value="kg">Quilograma(kg)</option>
                    <option value="unidade">Unidade</option>          
                </select>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold" >Eco Points</label>
                <input type="text" name="vl_eco" class="form-control" value="<?= $material['vl_eco']?>">
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

            <div class="mb-3 d-flex justify-content-between flex-row-reverse">
            <button type="submit" class="btn btn-primary font-weight-bold" name="editarMaterial" value="<?=$material['id_material']?>">Enviar</button>
            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.location.href='/projeto-eco/public/material/consultarMateriais'">Retornar</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</main>