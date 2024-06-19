<!-- <main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:99px">
        <h1 class="display-5 text-center text-primary titulo">Operação de Entrada</h1>
        
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
            <div class="row">
        <div class="col-md-5">
            <label class="font-weight-bold">Quantidade</label>
            <div class="mb-3">
            <input type="number" id="quantidade" name="qt_produtoentregue"
            value="<?= isset($dados['quantidade']) ? $dados['quantidade'] : '' ?>" class="form-control" placeholder="Quantidade" oninput="atualizarValor()">
            </div>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold" >Valor Unitário (R$)</label>
            <div class="mb-3">
            <input type="number" name="vl_unitario" id="valor_unitario"
            value="<?= isset($dados['real_valor']) ? $dados['real_valor'] : '' ?>" class="form-control" placeholder="Valor unitário" oninput="atualizarValor()" >
            </div>
        </div>
        <div class="col-md-2 d-flex align-items-end mb-3">
                    <button type="button" class="btn btn-primary" onclick="someFunction()">+</button>
                </div>
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
</script> -->

<main>
  <div class="container">
    <div class="row" style="margin-top: 99px;">
      <div class="col-md-6">
        <h1 class="display-5 text-center text-primary titulo">Operação de Entrada</h1>
        
        <?php if (!empty($dados['erros'])): ?>
          <div class="alert alert-danger mt-5">
            <?php foreach ($dados['erros'] as $erro): ?>
              <p><?php echo $erro; ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="../produto/cadastrarProdutoEntregue" class="mt-5" id="produtoForm">
          <div id="produtoContainer">
            <div class="produto-item">
              <div class="mb-3">
                <label class="font-weight-bold">Produto</label>
                <select type="text" name="idProduto[]" class="form-control"> 
                  <option value="">Selecione uma opção</option>
                  <?php if(isset($dados['produtos'])): ?>
                    <?php foreach($dados['produtos'] as $produto): ?>
                      <option value="<?=$produto['id_produto'] ?>" > <?= $produto['nm_produto'] ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label class="font-weight-bold">Quantidade</label>
                  <div class="mb-3">
                    <input type="number" name="qt_produtoentregue[]" class="form-control quantidade" placeholder="Quantidade" oninput="atualizarValor(this)">
                  </div>
                </div>
                <div class="col-md-5">
                  <label class="font-weight-bold">Valor Unitário (R$)</label>
                  <div class="mb-3">
                    <input type="number" name="vl_unitario[]" class="form-control valor_unitario" placeholder="Valor unitário" oninput="atualizarValor(this)">
                  </div>
                </div>
              </div>
              <label class="font-weight-bold">Valor Total</label>
              <div class="mb-3">
                <input type="text" name="vl_real[]" class="form-control valorFinal" placeholder="Valor total" readonly>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <button type="button" class="btn btn-primary font-weight-bold" onclick="adicionarProduto()">Adicionar Produto</button>
          </div>
        </form>
      </div>
      <div class="col-md-6">
        <h2 class="display-5 text-center text-primary titulo">Lista de Produtos</h2>
        <div id="listaProdutos"></div>
        <div class="text-center mt-3">
          <button id="verMaisBtn" type="button" class="btn btn-primary" onclick="verMais()">Ver Mais</button>
        </div>
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
  function atualizarValor(element) {
    const produtoItem = element.closest('.produto-item');
    const valorUnitario = parseFloat(produtoItem.querySelector('.valor_unitario').value) || 0;
    const quantidade = parseFloat(produtoItem.querySelector('.quantidade').value) || 0;
    const valorFinal = quantidade * valorUnitario;
    produtoItem.querySelector('.valorFinal').value = isNaN(valorFinal) ? '' : "R$ " + valorFinal.toFixed(2);
  }

  /**
   * Método para adicionar um novo conjunto de campos de produto à lista
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  function adicionarProduto() {
    const produtoContainer = document.getElementById('produtoContainer');
    const produtoItem = produtoContainer.querySelector('.produto-item');
    
    const produtoSelecionado = produtoItem.querySelector('select').selectedOptions[0].text;
    const quantidade = produtoItem.querySelector('.quantidade').value;
    const valorUnitario = produtoItem.querySelector('.valor_unitario').value;
    const valorTotal = produtoItem.querySelector('.valorFinal').value;

    if (produtoSelecionado === "Selecione uma opção" || quantidade === "" || valorUnitario === "") {
      alert("Por favor, preencha todos os campos do produto.");
      return;
    }

    const listaProdutos = document.getElementById('listaProdutos');
    const novoProduto = document.createElement('div');
    novoProduto.className = 'produto-item-lista';
    novoProduto.innerHTML = `
      <p>Produto: ${produtoSelecionado}</p>
      <p>Quantidade: ${quantidade}</p>
      <p>Valor Unitário: R$ ${parseFloat(valorUnitario).toFixed(2)}</p>
      <p>Valor Total: ${valorTotal}</p>
      <div>
        <button type="button" class="btn btn-primary btn-sm" onclick="editarProduto(this)">Editar</button>
        <button type="button" class="btn btn-danger btn-sm" onclick="excluirProduto(this)">Excluir</button>
      </div>
      <hr>
    `;

    listaProdutos.appendChild(novoProduto);

    atualizarVisibilidadeProdutos();
  }

  /**
   * Método para atualizar a visibilidade dos produtos na lista
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  function atualizarVisibilidadeProdutos() {
    const listaProdutos = document.getElementById('listaProdutos');
    const produtos = listaProdutos.querySelectorAll('.produto-item-lista');
    const verMaisBtn = document.getElementById('verMaisBtn');
    const maxProdutosVisiveis = 3;

    produtos.forEach((produto, index) => {
      if (index < maxProdutosVisiveis) {
        produto.style.display = 'block';
      } else {
        produto.style.display = 'none';
      }
    });

    if (produtos.length > maxProdutosVisiveis) {
      verMaisBtn.style.display = 'block';
    } else {
      verMaisBtn.style.display = 'none';
    }
  }

  /**
   * Método para mostrar mais produtos na lista
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  function verMais() {
    const listaProdutos = document.getElementById('listaProdutos');
    const produtos = listaProdutos.querySelectorAll('.produto-item-lista');
    const verMaisBtn = document.getElementById('verMaisBtn');
    const maxProdutosVisiveis = 3;

    let produtosVisiveis = 0;
    produtos.forEach((produto, index) => {
      if (produto.style.display === 'block') {
        produtosVisiveis++;
      }
    });

    produtos.forEach((produto, index) => {
      if (index < produtosVisiveis + maxProdutosVisiveis) {
        produto.style.display = 'block';
      }
    });

    if (produtosVisiveis + maxProdutosVisiveis >= produtos.length) {
      verMaisBtn.style.display = 'none';
    }
  }

  /**
   * Método para editar um produto da lista
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  function editarProduto(button) {
    const produtoItem = button.closest('.produto-item-lista');
    const produtoNome = produtoItem.querySelector('p:nth-child(1)').textContent.split(': ')[1];
    const quantidade = produtoItem.querySelector('p:nth-child(2)').textContent.split(': ')[1];
    const valorUnitario = produtoItem.querySelector('p:nth-child(3)').textContent.split(': R$ ')[1];
    const valorTotal = produtoItem.querySelector('p:nth-child(4)').textContent.split(': ')[1];

    const produtoContainer = document.getElementById('produtoContainer');
    const produtoFormItem = produtoContainer.querySelector('.produto-item');

    produtoFormItem.querySelector('select').value = produtoNome;
    produtoFormItem.querySelector('.quantidade').value = quantidade;
    produtoFormItem.querySelector('.valor_unitario').value = valorUnitario;
    produtoFormItem.querySelector('.valorFinal').value = valorTotal;

    produtoItem.remove();
  }

  /**
   * Método para excluir um produto da lista
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  function excluirProduto(button) {
    button.closest('.produto-item-lista').remove();
    atualizarVisibilidadeProdutos();
  }
</script>
