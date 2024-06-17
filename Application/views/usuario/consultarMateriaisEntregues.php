<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:95px">
        <h1 class="display-5 text-center text-primary mt-1 titulo">Materiais Entregues</h1>

        <?php 

        if (!empty($dados['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

       
        
        <form method="POST" action="../usuario/consultarMateriaisEntregues" class="mt-5">

            <div class="mb-3">
             
                <label class="font-weight-bold">Consulta:</label>
                <input type="number" name="cpf"    
                value="<?= isset($dados['cpf']) ? $dados['cpf'] : '' ?>" class="form-control" placeholder="Digite o CPF"> 
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary font-weight-bold" name="consultarMateriaisEntregues">Consultar</button>
        </div>
        <?php
        if(isset($_POST['consultarMateriaisEntregues']))
        { ?>
          <div class="alert alert-primary font-weight-bold" role="alert">
          Usuário:
          <?=isset($dados['usuario'][0]['nm_usuario']) ? ucfirst($dados['usuario'][0]['nm_usuario']) : 'Usuário não encontrado'?>
          </div> 
      <?php  }  ?>
        
      
        </form>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Material</th>
              <th id = "eco_valor_titulo" scope="col">Quantidade</th>
              <th id = "real_valor_titulo" scope="col">Eco Points</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($dados['query'])) 
            {
              foreach ($dados['query'] as $materiais) { ?>
                <tr>
                  <td><?= $materiais['nm_material'] ?></td>
                  <td><?= $materiais['qt_materialentregue'] ?></td>
                  <td> € <?= $materiais['vl_eco'] ?></td> 
                </tr> 
           <?php } ?> 
          
            <?php } ?>  
          </tbody>
        </table>
        
      </div>
    </div>
  </div>
</main>