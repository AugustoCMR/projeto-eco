<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:40px">
        <h1 class="display 2 text-center text-primary mt-5 titulo">Cadastrar Produto</h1>
        <?php
            
        if (!empty($data['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($data['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        
        <form method="POST" action="../produto/cadastrar_produto" class="mt-5">

        <div class="mb-3">
                <label class="font-weight-bold">Produto</label>
                <input type="text" name="produto" class="form-control">
        </div>
        <div class="mb-3">
                <label class="font-weight-bold">Eco Points</label>
                <input type="text" name="eco_valor" class="form-control">
        </div>

        <div class="mb-1">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrar_produto" value="cadastrar-categoria">Enviar</button>
        </div>

        </form>
        
      </div>
    </div>
  </div>
  <iframe width="1" height="54" frameborder="0"></iframe>
</main>