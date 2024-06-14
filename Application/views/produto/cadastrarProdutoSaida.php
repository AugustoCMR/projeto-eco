

<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:99px">
        <h1 class="display-5 text-center text-primary titulo">Operação de Saída</h1>
        
        <?php
        
          if (!empty($dados['erros'])): 
              ?>
              <div class="alert alert-danger mt-5">
                  <?php foreach ($dados['erros'] as $erro): ?>
                      <p><?php echo $erro; ?></p>
                  <?php endforeach; ?>
              </div>
        <?php endif; ?>

        <form method="POST" action="../produto/cadastrarProdutoSaida" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold" >Produto</label>
                <select type="text" name="idProduto" id="produto" class="form-control" onchange="atualizarQuantidade_Valor()"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                        
                        if(isset($dados['produtos']))
                        { 
                            foreach($dados['produtos'] as $produto)
                            { ?>
                            <option value="<?=$produto['id_produto'] ?>" data-produto="<?=$produto['qt_produto']?>" data-valor="<?=$produto['vl_eco'] ?>"> <?= $produto['nm_produto'] ?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                </select>
            </div>

            <label class="font-weight-bold">Valor do Produto(€)</label>
            <div class="mb-3">
            <input type="text" name="vl_eco"
            value="<?= isset($dados['eco_valor']) ? $dados['eco_valor'] : '' ?>" class="form-control" placeholder="Valor do Produto" id="valorUnitario" oninput="atualizaValorFinal()" readonly>
            </div>

            <label class="font-weight-bold">Quantidade(<span id="quantidade_linha">Escolha um Produto</span>)</label>
            <div class="mb-3">
            <input type="number" id="quantidade" name="qt_produtoretirado"
            value="<?= isset($dados['quantidade']) ? $dados['quantidade'] : '' ?>" class="form-control" placeholder="Quantidade" oninput="atualizaValorFinal()" readonly>
            </div>
            
            <div class="mb-3">
              <label class="font-weight-bold" >Usuario</label>
              <select type="number" name="idUsuario" id="usuario" class="form-control" onchange="atualizarSaldoUsuario()"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                       
                        if(isset($dados['usuarios']))
                        { 
                            
                            foreach($dados['usuarios'] as $usuarios)
                            { ?>
                            <option value="<?=$usuarios['id_usuario'] ?>" data-saldo="<?=$usuarios['vl_ecosaldo']?>" > <?= $usuarios['nm_usuario'] ?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                    </select>
            
            </div>
        
            <label class="font-weight-bold" style="">Saldo</label>
            <div class="mb-3">
            <input type="text" name="vl_ecosaldo" id="saldo_usuario" 
            value="<?= isset($dados['eco_valor']) ? $dados['eco_valor'] : '' ?>" class="form-control" placeholder="Saldo" readonly>
            </div>


            <label class="font-weight-bold">Valor final do Produto(€)</label>
            <div class="mb-3">
            <input type="text" id="valorFinal" name="vl_eco"
            value="<?= isset($dados['eco_valor']) ? $dados['eco_valor'] : '' ?>" class="form-control" placeholder="Valor Final" oninput="atualizarSaldoUsuario_valorFinal()" readonly>
            </div>


            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrarProdutoSaida" id="botaoFinalizar" value="cadastrar-categoria" onchange="atualizaValorFinal()" disabled>Finalizar</button>
        </div>

           
        </form>
        
      </div>
    </div>
  </div>
</main>

<script>
  function atualizarQuantidade_Valor()
  {
    const produto = document.getElementById('produto');
    const opcaoSelecionada = produto.options[produto.selectedIndex];
    const quantidade = opcaoSelecionada.getAttribute('data-produto');
    const valor = opcaoSelecionada.getAttribute('data-valor');
    document.getElementById('valorUnitario').value = isNaN(valor) ? '' : '€ ' + parseFloat(valor).toFixed(2); 
    document.getElementById('quantidade_linha').innerText = 
    quantidade || 'Sem estoque';
    document.getElementById('quantidade').value='';

    const quantidadeInput = document.getElementById('quantidade');
    quantidadeInput.max = quantidade || 0;

    if (quantidade > 0) 
    {
        quantidadeInput.removeAttribute('readonly');

    } else {
        quantidadeInput.setAttribute('readonly', 'readonly');
    }

    atualizaValorFinal();
    
  }

  document.getElementById('quantidade').addEventListener('input', function() {
    const max = parseInt(this.max, 10);
    if (parseInt(this.value, 10) > max) {
      this.value = max;
    }
    atualizaValorFinal();
  });

  function atualizarSaldoUsuario()
  {
    const usuario = document.getElementById('usuario');
    const opcaoSelecionada = usuario.options[usuario.selectedIndex];
    const saldo = opcaoSelecionada.getAttribute('data-saldo');
    document.getElementById('saldo_usuario').value = "€ " + parseFloat(saldo).toFixed(2);
    atualizaValorFinal()
    
  }

  function atualizaValorFinal()
  {

    const produto = document.getElementById('produto');
    const opcaoSelecionada = produto.options[produto.selectedIndex];
    const valor = opcaoSelecionada.getAttribute('data-valor');
    const quantidade = document.getElementById('quantidade').value;
    const valorFinal = quantidade * valor;
    document.getElementById('valorFinal').value = isNaN(valorFinal) ? '' : "€ " + valorFinal.toFixed(2);
    
    const saldoFormatado = document.getElementById('saldo_usuario').value.split("€")[1];

    if(valorFinal > saldoFormatado || isNaN(saldoFormatado) || saldoFormatado <= 0) 
    {
      document.getElementById("botaoFinalizar").setAttribute('disabled', 'disabled');
    } else
    {
      document.getElementById("botaoFinalizar").removeAttribute('disabled');
    }
  }
</script>