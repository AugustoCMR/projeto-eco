<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:50px">
        <h1 class="display 4 text-center text-primary mt-5 titulo">Editar Resíduo</h1>
        <?php
            
        if (!empty($dados['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php $residuo = $dados['residuo'][0]?>
        <form method="POST" action="/projeto-eco/public/material/editarResiduo" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold">Resíduo</label>
                <input type="text" name="nm_residuo" class="form-control" value="<?= ucfirst($residuo['nm_residuo']) ?>">
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="editarResiduo" value="<?= $residuo['id_residuo'] ?>">Editar</button>
            </div>
        </form>        
        
        </div>
      </div>
    </div>
</main>