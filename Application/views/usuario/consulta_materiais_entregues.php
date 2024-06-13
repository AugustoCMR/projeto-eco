<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display-5 text-center text-primary font-weight-bold mt-5 titulo">Materiais Entregues</h1>

        <?php 

        if (!empty($data['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($data['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="../user/consultar_materiais_entregues" class="mt-5">

            <div class="mb-3">
                <label class="font-weight-bold">Consulta:</label>
                <input type="text" name="cpf"    
                value="<?= isset($data['cpf']) ? $data['cpf'] : '' ?>" class="form-control" placeholder="Digite o CPF"> 
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary font-weight-bold" name="submit_consultar">Consultar</button>
        </div>

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
            if(!empty($data['query'])) 
            {
              foreach ($data['query'] as $materiais) { ?>
                <tr>
                  <td><?= $materiais['name'] ?></td>
                  <td><?= $materiais['quantidade'] ?></td>
                  <td> € <?= $materiais['eco_valor'] ?></td> 
                </tr> 
           <?php } ?> 
          
            <?php } ?>  
          </tbody>
        </table>
        
      </div>
    </div>
  </div>
</main>