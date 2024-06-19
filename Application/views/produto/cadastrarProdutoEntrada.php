<main>
    <div class="container">
    	<div class="row">
        	<div class="col-8 offset-2" style="margin-top:99px">
        		<h1 class="display 4 text-center text-primary titulo">Operação de Entrada</h1>

        <?php if (!empty($dados['erros'])): ?>
            <div class="alert alert-danger mt-5">
            	<?php foreach ($dados['erros'] as $erro): ?>
                	<p><?php echo $erro; ?></p>
            	<?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../produto/cadastrarProdutoEntregue" class="mt-5">
			<div class="row">

			<div class="col-md-5">
            	<div class="mb-3">
            		<label class="font-weight-bold">Produto</label>
            			<select name="idProduto" id="produto" class="form-control" onchange="atualizaValorUnitario()"> 
                			<option value="">Selecione uma opção</option>
                				<?php if(isset($dados['produtos'])) { 
                			foreach($dados['produtos'] as $produto) { ?>
                    	<option value="<?=$produto['id_produto'] ?>" data-eco="<?= $produto['vl_eco']?>"> <?= $produto['nm_produto'] ?></option> 
                	<?php } } ?> 
            	</select>
            </div>
          
          <label class="font-weight-bold">Quantidade</label>
          	<div class="mb-3">
        		<input type="number" id="quantidade" name="qt_produtoentregue"
              	value="<?= isset($dados['quantidade']) ? $dados['quantidade'] : '' ?>" class="form-control" placeholder="Quantidade" oninput="atualizarValor()">
          	</div>

            <label class="font-weight-bold">Valor Unitário (R$)</label>
            <div class="mb-3">
            <input type="text" name="vl_unitario" id="valor_unitario"
              value="<?= isset($dados['real_valor']) ? $dados['real_valor'] : '' ?>" class="form-control" placeholder="Valor unitário" oninput="atualizarValor()" readonly>
          </div>

          <label class="font-weight-bold">Valor Total</label>
          <div class="mb-3">
            <input type="text" id="valorFinal" name="vl_real"
              value="<?= isset($dados['real_valor']) ? $dados['real_valor'] : '' ?>" class="form-control" placeholder="Valor total" readonly>
          </div>

          <div class="mb-3">
            <button type="button" class="btn btn-primary font-weight-bold" onclick="adicionarMaterial()">Adicionar</button>
            <button type="submit" class="btn btn-primary font-weight-bold" name="cadastrarProdutoEntregue">Finalizar Cadastro</button>
            </div>
		</div>

          <div class="col-md-7 table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table mt-5" id="produtosAdicionados">
              <thead>
                <tr>
                  <th style="display:none;">ID Produto</th> 
                  <th style="display:none;">Valor Unitário</th>
                  <th>Produto</th>
                  <th>Quantidade</th>
                  <th>Valor(R$)</th>
                  <th>Ação</th>
                </tr>
                </thead>
            <tbody></tbody>
        </table>
	</div>

        <input type="hidden" name="dadosTabela" id="dadosTabela"> 
        </form>
        
       </div>
    </div>
</div>
</main>

<script>
  function atualizarValor() 
  {   
  const valorUnitario = parseFloat(document.getElementById('valor_unitario').value.replace("R$ ", "").replace(",", "."));
  const quantidade = parseFloat(document.getElementById('quantidade').value);
  const valorFinal = quantidade * valorUnitario;
  document.getElementById('valorFinal').value = isNaN(valorFinal) ? '' : "R$ " + valorFinal.toFixed(2).replace(".", ",");
  }

function atualizaValorUnitario() 
{
  const produto = document.getElementById('produto');
  const opcaoSelecionada = produto.options[produto.selectedIndex];
  const valorProduto = parseFloat(opcaoSelecionada.getAttribute('data-eco'));
  const valorFinal = valorProduto * <?= $dados['cotacao_real'] / $dados['cotacao_eco'] ?>;
  document.getElementById('valor_unitario').value = "R$ " + valorFinal.toFixed(2).replace(".", ",");
  atualizarValor();
}

function adicionarMaterial() 
{
  const produtoSelect = document.getElementById('produto');
  const quantidade = document.getElementById('quantidade').value;
  const valorUnitario = document.getElementById('valor_unitario').value;
  const valorFinal = document.getElementById('valorFinal').value;

  if (!produtoSelect.value || !quantidade || !valorFinal) {
    alert('Preencha todos os campos antes de adicionar.');
    return;
  }

  const produtoText = produtoSelect.options[produtoSelect.selectedIndex].text;
  const idProduto = produtoSelect.value;
  const tbody = document.getElementById('produtosAdicionados').querySelector('tbody');

  const row = document.createElement('tr');
  row.innerHTML = `
    <td style="display:none;">${idProduto}</td>
    <td style="display:none;">${valorUnitario}</td>
    <td>${produtoText}</td>
    <td>${quantidade}</td>
    <td>${valorFinal}</td>
    <td><button type="button" class="btn btn-danger btn-sm" onclick="removerMaterial(this)">-</button></td>`;
  tbody.appendChild(row);

  produtoSelect.value = '';
  document.getElementById('quantidade').value = '';
  document.getElementById('valor_unitario').value = '';
  document.getElementById('valorFinal').value = '';

  atualizarDadosTabela();
}

function atualizarDadosTabela() 
{
  const tbody = document.getElementById('produtosAdicionados').querySelector('tbody');
  const dados = [];

  for (let row of tbody.children) {
    const idProduto = row.children[0].innerText;
    const valorUnitario = row.children[1].innerText;
    const quantidade = row.children[3].innerText;
    const valorFinal = row.children[4].innerText;

    const item = {
      idProduto: idProduto,
      valorUnitario: valorUnitario,
      quantidade: quantidade,
      valorFinal: valorFinal
    };

    dados.push(item);
  }

  document.getElementById('dadosTabela').value = JSON.stringify(dados);
}

function removerMaterial(button) {
  const row = button.closest('tr');
  row.remove();
  atualizarDadosTabela();
}

</script>