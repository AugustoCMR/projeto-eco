

<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Operação de Saída</h1>
        


        <form method="POST" action="../produto/cadastrar_operacao_saida_produto_sucesso" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold" style="">Produto</label>
                <select type="text" name="produto_id" id="produto" class="form-control" onchange="atualizarQuantidade_Valor()"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                        
                        if(isset($data['produtos']))
                        { 
                            foreach($data['produtos'] as $produto)
                            { ?>
                            <option value="<?=$produto['id'] ?>" data-produto="<?=$produto['quantidade']?>" data-valor="<?=$produto['eco_valor']?>"> <?= $produto['nome'] ?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                </select>
            </div>

            <label class="font-weight-bold" style="">Valor do Produto(€)</label>
            <div class="mb-3">
            <input type="text" name="eco_valor"
            value="<?= isset($data['eco_valor']) ? $data['eco_valor'] : '' ?>" class="form-control" placeholder="Valor do Produto" id="valorUnitario" oninput="atualizaValorFinal()" readonly>
            </div>

            <label class="font-weight-bold" style="">Quantidade(<span id="quantidade_linha">Escolha um Produto</span>)</label>
            <div class="mb-3">
            <input type="number" id="quantidade" name="quantidade"
            value="<?= isset($data['quantidade']) ? $data['quantidade'] : '' ?>" class="form-control" placeholder="Quantidade" oninput="atualizaValorFinal()">
            </div>
            
            <div class="mb-3">
              <label class="font-weight-bold" >Usuario</label>
              <select type="number" name="usuario_id" id="usuario" class="form-control" onchange="atualizarSaldoUsuario()"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                       
                        if(isset($data['usuarios']))
                        { 
                            
                            foreach($data['usuarios'] as $usuarios)
                            { ?>
                            <option value="<?=$usuarios['id'] ?>" data-saldo="<?=$usuarios['eco_saldo']?>" > <?= $usuarios['nome'] ?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                    </select>
            
            </div>
        
            <label class="font-weight-bold" style="">Saldo</label>
            <div class="mb-3">
            <input type="text" name="eco_valor" id="usuario_saldo" 
            value="<?= isset($data['eco_valor']) ? $data['eco_valor'] : '' ?>" class="form-control" placeholder="Saldo" readonly>
            </div>


            <label class="font-weight-bold" style="">Valor final</label>
            <div class="mb-3">
            <input type="text" id="valorFinal" name="eco_valor"
            value="<?= isset($data['eco_valor']) ? $data['eco_valor'] : '' ?>" class="form-control" placeholder="Valor Final" oninput="atualizarSaldoUsuario_valorFinal()" readonly>
            </div>


            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrar_saida_produto"  value="cadastrar-categoria">Finalizar</button>
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


    const quantidadeInput = document.getElementById('quantidade');
    quantidadeInput.max = quantidade || 0;

    if (quantidade > 0) {
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
  });

  function atualizarSaldoUsuario()
  {
    const usuario = document.getElementById('usuario');
    const opcaoSelecionada = usuario.options[usuario.selectedIndex];
    const saldo = opcaoSelecionada.getAttribute('data-saldo');
    document.getElementById('usuario_saldo').value = saldo;

  }

  function atualizaValorFinal()
  {

    const produto = document.getElementById('produto');
    const opcaoSelecionada = produto.options[produto.selectedIndex];
    const valor = opcaoSelecionada.getAttribute('data-valor');
    const quantidade = document.getElementById('quantidade').value;
    const valorFinal = quantidade * valor;
    document.getElementById('valorFinal').value = isNaN(valorFinal) ? '' : valorFinal.toFixed(2);
  }
</script>