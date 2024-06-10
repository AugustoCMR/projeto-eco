<<<<<<< HEAD


<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Cadastrar Produto</h1>
        


        <form method="POST" action="../produto/cadastrar_produto_sucesso" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold" style="">Produto</label>
                <input type="text" style="" name="nome"    
                value="<?= isset($data['nome']) ? $data['nome'] : '' ?>" class="form-control" placeholder="Nome">
            </div>
        
            <label class="font-weight-bold" style="">Eco Points</label>
            <div class="mb-3">
            <input type="text" style="" name="eco_valor"
            value="<?= isset($data['eco_valor']) ? $data['eco_valor'] : '' ?>" class="form-control" placeholder="Eco Points">
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrar-produto"  value="cadastrar-produto">Enviar</button>
        </div>

           
=======
<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display 4 text-center text-primary">Cadastrar Produto</h1>
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

        <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrar_produto" value="cadastrar-categoria">Enviar</button>
        </div>
>>>>>>> augusto
        </form>
        
      </div>
    </div>
  </div>
</main>