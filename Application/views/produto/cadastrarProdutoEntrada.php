<main>
    <div class="container">
    	<div class="row">
        	<div class="col-10 offset-1" style="margin-top:99px">
        		<h1 class="display 4 text-center text-primary titulo">Operação de Entrada</h1>

        <?php if (!empty($dados['erros'])): ?>
            <div class="alert alert-danger mt-5">
            	<?php foreach ($dados['erros'] as $erro): ?>
                	<p><?php echo $erro; ?></p>
            	<?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../produto/cadastrarProdutoEntregue" class="mt-5" id="produtoForm">
			<div class="row">

			<div class="col-md-4">
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

            <label class="font-weight-bold">Valor Total (R$)</label>
            <div class="mb-3">
            <input type="text" id="valorFinal" name="vl_real"
              value="<?= isset($dados['real_valor']) ? $dados['real_valor'] : '' ?>" class="form-control" placeholder="Valor total" readonly>
            </div>

            <div class="mb-3">
        <label class="font-weight-bold">Valor Total €</label>
        <input type="text" id="valorTotal" class="form-control" readonly>
        </div>

          <div class="mb-3">
            <button type="button" class="btn btn-primary font-weight-bold" onclick="adicionarMaterial()">Adicionar</button>
            <button type="submit" class="btn btn-primary font-weight-bold" name="cadastrarProdutoEntregue">Finalizar Cadastro</button>
            </div>
		</div>

          <div class="col-md-8 table-responsive" style="max-height: 350px; overflow-y: auto;">
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

          <input type="hidden" name="dadosTabela" id="dadosTabela" value='<?php echo isset($dados['tabela']) ? json_encode($dados['tabela']) : '[]'; ?>'> 
        </form>
        
       </div>
    </div>
</div>
</main>

<script>

function atualizarValorTotal() {
    const tbody = document.getElementById('materiaisAdicionados').querySelector('tbody');
    let valorTotal = 0;

    for (let row of tbody.children) {
        valorTotal += parseFloat(row.children[5].innerText);
    }

    document.getElementById('valorTotal').value = valorTotal.toFixed(2);
}
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

  for (let row of tbody.children) 
    {
        if (row.children[0].innerText === idProduto) 
        {
            alert('Este produto já foi adicionado.');
            return;
        }
    }

    if(quantidade <= 0)
    {
        alert('Quantidade não pode ser menor que um');
        return;
    }

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
  atualizarValorTotal();
}

function atualizarDadosTabela() 
{
  const tbody = document.getElementById('produtosAdicionados').querySelector('tbody');
  const dados = [];

  for (let row of tbody.children) {
    const idProduto = row.children[0].innerText;
    const valorUnitario = row.children[1].innerText;
    const nm_produto = row.children[2].innerText;
    const quantidade = row.children[3].innerText;
    const valorFinal = row.children[4].innerText;

    const item = {
      idProduto: idProduto,
      valorUnitario: valorUnitario,
      nm_produto: nm_produto,
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
  atualizarValorTotal();
}

document.getElementById('produtoForm').addEventListener('submit', function(event) {
  const tbody = document.getElementById('produtosAdicionados').querySelector('tbody');
  if (tbody.children.length === 0) {
    alert('Adicione pelo menos um produto antes de finalizar.');
    event.preventDefault();
  }
});

document.addEventListener('DOMContentLoaded', function() {
    const tabela = document.getElementById('produtosAdicionados').querySelector('tbody');
    const dadosTabela = document.getElementById('dadosTabela').value;
    const produtosAdicionados = JSON.parse(dadosTabela);

    produtosAdicionados.forEach(item => { 
      
        const row = document.createElement('tr');
        row.innerHTML = `
            <td style="display:none;">${item.idProduto}</td>
            <td style="display:none;">${item.valorUnitario}</td>
            <td>${document.querySelector(`#produto option[value='${item.idProduto}']`).text}</td>
            <td>${item.quantidade}</td>
            <td>${item.valorFinal}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removerMaterial(this)">-</button></td>
        `;
        tabela.appendChild(row);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const tabela = document.getElementById('materiaisAdicionados').querySelector('tbody');
    const dadosTabela = document.getElementById('dadosTabela').value;
    const materiaisAdicionados = JSON.parse(dadosTabela);

    materiaisAdicionados.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `<td style="display:none;">${item.idUsuario}</td>
            <td style="display:none;">${item.idMaterial}</td>
            <td>${document.querySelector(`#usuario option[value='${item.idUsuario}']`).text}</td>
            <td>${document.querySelector(`#material option[value='${item.idMaterial}']`).text}</td>
            <td>${item.quantidade}</td>
            <td>${item.valorFinal}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removerMaterial(this)">-</button></td>`;
        tabela.appendChild(row);
    });

    atualizarValorTotal();
});

</script>