<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display 4 text-center text-primary">Novo Resíduo</h1>
        <?php
            
        if (!empty($data['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($data['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../material/register_type_residue" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold" style="">Nome</label>
                <input type="text" name="nome" class="form-control">
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrar_residuo" style="" value="cadastrar-categoria">Enviar</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</main>