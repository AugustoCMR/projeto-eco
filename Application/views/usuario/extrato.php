<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:49px">
        <h1 class="display-5 text-center text-primary mt-5 titulo">Extrato</h1>

        <?php 

        if (!empty($dados['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="../usuario/extrato" class="mt-5">

            <div class="mb-3">
                <label class="font-weight-bold">Consulta:</label>
                <input type="text" name="cpf"    
                value="<?= isset($dados['cpf']) ? $dados['cpf'] : '' ?>" class="form-control" placeholder="Digite o CPF"> 
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary font-weight-bold" name="consultarExtrato" value="cadastrar-categoria">Consultar</button>
        </div>

        <?php
        if(isset($_POST['consultarExtrato']))
        { ?>
          <div class="alert alert-primary font-weight-bold" role="alert">
          Usuário:
          <?=isset($dados['usuario'][0]['nm_usuario']) ? ucfirst($dados['usuario'][0]['nm_usuario']) : 'Usuário não encontrado'?>
          </div> 
          <div class="alert alert-primary font-weight-bold" role="alert">
          Saldo atual:
          <?=isset($dados['usuario'][0]['vl_ecosaldo']) ? '€ ' . ucfirst($dados['usuario'][0]['vl_ecosaldo']) : '€ 0'?>
          </div> 
        <?php  }  ?>

        </form>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Material/Produto</th>
              <th id = "real_valor_titulo" scope="col">Entradas</th>
              <th id = "real_valor_titulo" scope="col">Saidas</th>
              <th id = "real_valor_titulo" scope="col">Saldo</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($dados['dados'])) 
            {
              foreach ($dados['dados'] as $dados) { ?>
                <tr>
                  <td><?= (isset($dados['nome_material']) ?  $dados['nome_material'] . "(MATERIAL)" : $dados['nome_produto'] . "(PRODUTO)")?></td>
                  <td><?= isset($dados['entrada']) ? "€ " . $dados['entrada'] : "" ?></td>  
                  <td><?= isset($dados['saida']) ? "€ " . $dados['saida'] : "" ?></td> 
                  <td><?= (isset($dados['saldo_atual_entrada']) ? "€ " . $dados['saldo_atual_entrada'] : "€ " . $dados['saldo_atual_saida'] ) ?></td> 
                </tr> 
           <?php } ?> 
          
            <?php } ?>
          </tbody>
        </table>
        
      </div>
    </div>
  </div>
</main>