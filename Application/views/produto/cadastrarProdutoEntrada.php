<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display-5 text-center text-primary font-weight-bold titulo">Operação de Entrada</h1>
        
        <?php
        
          if (!empty($dados['erros'])): 
              ?>
              <div class="alert alert-danger mt-5">
                  <?php foreach ($dados['erros'] as $erro): ?>
                      <p><?php echo $erro; ?></p>
                  <?php endforeach; ?>
              </div>
        <?php endif; ?>

        <form method="POST" action="../produto/cadastrarProdutoEntregue" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold">Produto</label>
                <select type="text" name="idProduto" id="categoria" class="form-control"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                   
                        if(isset($dados['produtos']))
                        { 
                            foreach($dados['produtos'] as $produto)
                            { ?>
                            <option value="<?=$produto['id_produto'] ?>" > <?= $produto['nm_produto'] ?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                </select>
            </div>
        
            <label class="font-weight-bold" style="">Quantidade</label>
            <div class="mb-3">
            <input type="number" id="quantidade" name="qt_produtoentregue"
            value="<?= isset($dados['quantidade']) ? $dados['quantidade'] : '' ?>" class="form-control" placeholder="Quantidade" oninput="atualizarValor()">
            </div>

            <label class="font-weight-bold" >Valor Unitário (R$)</label>
            <div class="mb-3">
            <input type="number" name="vl_unitario" id="valor_unitario"
            value="<?= isset($dados['real_valor']) ? $dados['real_valor'] : '' ?>" class="form-control" placeholder="Valor unitário" oninput="atualizarValor()">
            </div>

            <label class="font-weight-bold" >Valor Total</label>
            <div class="mb-3">
            <input type="text" id="valorFinal" name="vl_real"
            value="<?= isset($dados['real_valor']) ? $dados['real_valor'] : '' ?>" class="form-control" placeholder="Valor total" readonly>
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrarProdutoEntregue">Enviar</button>
        </div>

           
        </form>
        
      </div>
    </div>
  </div>
</main>

<script>
      /**
   * Método para atualizar o valor em tempo real
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  function atualizarValor()
    {   
        const valorUnitario = document.getElementById('valor_unitario').value;
        const quantidade = document.getElementById('quantidade').value;
        const valorFinal = quantidade * valorUnitario;
        document.getElementById('valorFinal').value=isNaN(valorFinal) ? '' : "R$ " + valorFinal.toFixed(2);
    }
</script>