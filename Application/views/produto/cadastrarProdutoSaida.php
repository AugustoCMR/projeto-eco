<main>
	<div class="container">
		<div class="row">
			<div class="col-8 offset-2" style="margin-top:99px">
				<h1 class="display-5 text-center text-primary titulo">Operação de Saída</h1>
			
		<?php if (!empty($dados['erros'])): ?>
			<div class="alert alert-danger mt-5">
				<?php foreach ($dados['erros'] as $erro): ?>
					<p><?php echo $erro; ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<form method="POST" action="../produto/cadastrarProdutoSaida" class="mt-5" id="produtoForm">
			<div class="row">
		
			<div class="col-md-5">
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
				<input type="text" name="vl_ecoProduto" id="valorProduto"
				value="<?= isset($dados['eco_valor']) ? $dados['eco_valor'] : '' ?>" class="form-control" placeholder="Valor do Produto" id="valorUnitario" oninput="atualizaValorFinal()" readonly>
				</div>

            <label class="font-weight-bold">Quantidade(<span id="quantidade_linha">Escolha um Produto</span>)</label>
            <div class="mb-3">
            <input type="number" id="quantidade" name="qt_produtoretirado"
            value="<?= isset($dados['quantidade']) ? $dados['quantidade'] : '' ?>" class="form-control" placeholder="Quantidade" oninput="atualizaValorFinal()" readonly>
            </div>
            
            <div class="mb-3">
              <label class="font-weight-bold" >Usuario</label>
              <select type="number" name="idUsuario" id="usuario"  class="form-control" <?php echo isset($dados['nm_usuario']) ? 'disabled' : ''; ?>  onchange="atualizarSaldoUsuario()"> 
                    <option value="<?= isset($dados['id_usuario']) ? $dados['id_usuario'] : '' ?>"><?= isset($dados['nm_usuario']) ? $dados['nm_usuario'] : 'Selecione uma opção' ?></option>
                    <?php 
                       
                        if(isset($dados['usuarios']))
                        { 
                            
                            foreach($dados['usuarios'] as $usuarios)
                            { ?>
                            <option value="<?=$usuarios['id_usuario'] ?>" data-saldo="<?=$usuarios['vl_ecosaldo']?>" > <?= ucfirst($usuarios['nm_usuario']) ?> - CPF: <?=$usuarios['nu_cpf']?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                    </select>
            
            </div>
        
            <label class="font-weight-bold" >Saldo</label>
            <div class="mb-3">
            <input type="text" name="vl_ecosaldo" id="saldo_usuario" 
            value="<?= isset($dados['saldoUsuario']) ? $dados['saldoUsuario'] : '' ?>" class="form-control" placeholder="Saldo" readonly>
            </div>


				<label class="font-weight-bold">Valor final do Produto(€)</label>
				<div class="mb-3">
				<input type="text" id="valorFinal" name="vl_ecoTotal"
				value="<?= isset($dados['eco_valor']) ? $dados['eco_valor'] : '' ?>" class="form-control" placeholder="Valor Final" oninput="atualizarSaldoUsuario_valorFinal()" readonly>
				</div>


				<div class="mb-3">
				<button type="button" class="btn btn-primary font-weight-bold" id="btnAdicionar" onclick="adicionarProduto()">Adicionar</button>
				<button type="submit" class="btn btn-primary font-weight-bold" name="cadastrarProdutoSaida">Finalizar Cadastro</button>
				</div> 
			</div>    

	<div class="col-md-7 table-responsive" style="max-height: 400px; overflow-y: auto;">
		<table class="table mt-5" id="produtosAdicionados">
			<thead>
				<tr>
					<th style="display:none;">ID Produto</th>
					<th style="display:none;">ID Usuario</th> 
					<th style="display:none;">Valor do Produto</th>
					<th style="display:none;">Saldo Usuário</th>
					<th>Usuário</th>
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
  function atualizarQuantidade_Valor()
  {
    const produto = document.getElementById('produto');
    const opcaoSelecionada = produto.options[produto.selectedIndex];
    const quantidade = opcaoSelecionada.getAttribute('data-produto');
    const valor = opcaoSelecionada.getAttribute('data-valor');
    document.getElementById('valorProduto').value = isNaN(valor) ? '' : '€ ' + parseFloat(valor).toFixed(2); 
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
      document.getElementById("btnAdicionar").setAttribute('disabled', 'disabled');
    } else
    {
      document.getElementById("btnAdicionar").removeAttribute('disabled');
    }
  }

  function adicionarProduto() 
  {
    const produtoSelect = document.getElementById('produto');
    const usuarioSelect = document.getElementById('usuario');
    const quantidade = document.getElementById('quantidade').value;
    const valorProduto = document.getElementById('valorProduto').value;
    const valorFinal = document.getElementById('valorFinal').value;
    const saldoUsuario = document.getElementById('saldo_usuario').value;

    console.log(usuarioSelect.value);
    console.log(produtoSelect.value);

    if (!produtoSelect.value || !usuarioSelect.value || !quantidade || !valorFinal || !valorProduto || !saldoUsuario) {
      alert('Preencha todos os campos antes de adicionar.');
      return;
    }

    const produtoText = produtoSelect.options[produtoSelect.selectedIndex].text;
    const usuarioText = usuarioSelect.options[usuarioSelect.selectedIndex].text;
    const idUsuario = usuarioSelect.value;
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
      <td style="display:none;">${idUsuario}</td>
      <td style="display:none;">${valorProduto}</td>
      <td style="display:none;">${saldoUsuario}</td>
      <td>${usuarioText}</td>
      <td>${produtoText}</td>
      <td>${quantidade}</td>
      <td>${valorFinal}</td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="removerMaterial(this)">-</button></td>`;
    tbody.appendChild(row);

    usuarioSelect.disabled = true;
    produtoSelect.value = '';
    document.getElementById('valorProduto').value = '';
    document.getElementById('quantidade').value = '';
    document.getElementById('valorFinal').value = '';
    document.getElementById('quantidade_linha').innerText = 'Escolha um Produto';

    atualizarDadosTabela();
  }

function atualizarDadosTabela() 
{
    const tbody = document.getElementById('produtosAdicionados').querySelector('tbody');
    const dados = [];

    for (let row of tbody.children) {
      const idProduto = row.children[0].innerText;
      const idUsuario = row.children[1].innerText;
      const valorProduto = row.children[2].innerText;
      const saldoUsuario = row.children[3].innerText;
      const nm_usuario = row.children[4].innerText;
      const quantidade = row.children[6].innerText;
      const valorFinal = row.children[7].innerText;

      const item = {
        idProduto: idProduto,
        idUsuario:idUsuario,
        valorProduto: valorProduto,
        quantidade: quantidade,
        saldoUsuario: saldoUsuario,
        valorFinal: valorFinal,
        nm_usuario: nm_usuario
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

  document.getElementById('produtoForm').addEventListener('submit', function(event) {
  const tbody = document.getElementById('produtosAdicionados').querySelector('tbody');
  if (tbody.children.length === 0) {
    alert('Adicione pelo menos um produto antes de finalizar.');
    event.preventDefault();
  }
});

  document.addEventListener('DOMContentLoaded', function() 
  {
        const tabela = document.getElementById('produtosAdicionados').querySelector('tbody');
        const dadosTabela = document.getElementById('dadosTabela').value;
        const produtosAdicionados = JSON.parse(dadosTabela);

        produtosAdicionados.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = 
            `<td style="display:none;">${item.idProduto}</td>
                <td style="display:none;">${item.idUsuario}</td>
                <td style="display:none;">${item.valorProduto}</td>
                <td style="display:none;">${item.saldoUsuario}</td>
                <td>${document.querySelector(`#usuario option[value='${item.idUsuario}']`).text}</td> 
                <td>${document.querySelector(`#produto option[value='${item.idProduto}']`).text}</td>
                <td>${item.quantidade}</td>
                <td>${item.valorFinal}</td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removerMaterial(this)">-</button></td>`;
            tabela.appendChild(row);
        });
  });
</script>