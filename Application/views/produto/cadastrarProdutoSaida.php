<!-- <main>
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
          <div id="produtoContainer">
            <div class="produto-bloco">
            <div class="row">
            <div class="col-md-5">
              <div class="mb-3">
                <label class="font-weight-bold">Produto</label>
                <select type="text" name="idProduto[]" class="form-control produto-select" onchange="atualizarQuantidade_Valor(this)"> 
                  <option value="">Selecione uma opção</option>
                  <?php if(isset($dados['produtos'])) { 
                    foreach($dados['produtos'] as $produto) { ?>
                      <option value="<?=$produto['id_produto'] ?>" data-produto="<?=$produto['qt_produto']?>" data-valor="<?=$produto['vl_eco'] ?>"> <?= $produto['nm_produto'] ?> - € <?= $produto['vl_eco'] ?></option>
                  <?php } } ?>
                </select>
              </div>
            </div>
            <div class="col-md-5">
              <div class="mb-3">
                <label class="font-weight-bold">Quantidade(<span class="quantidade-linha">Escolha um Produto</span>)</label>
                <input type="number" name="qt_produtoretirado[]" class="form-control quantidade" placeholder="Quantidade" oninput="atualizaValorFinal()" readonly>
              </div>
            </div>
            <div class="col-md-1 d-flex align-items-end mb-3 ml-0">
              <button type="button" class="btn btn-primary" onclick="adicionarProduto()">+</button>
            </div>
            </div>
            </div>
          </div>

              <div class="mb-3">
                <label class="font-weight-bold">Usuario</label>
                <select type="number" name="idUsuario" id="usuario" class="form-control" onchange="atualizarSaldoUsuario()"> 
                  <option value="">Selecione uma opção</option>
                  <?php if(isset($dados['usuarios'])) { 
                    foreach($dados['usuarios'] as $usuarios) { ?>
                      <option value="<?=$usuarios['id_usuario'] ?>" data-saldo="<?=$usuarios['vl_ecosaldo']?>"> <?= ucfirst($usuarios['nm_usuario']) ?> - CPF: <?=$usuarios['nu_cpf']?></option>
                  <?php } } ?>
                </select>
            </div>
              <div class="mb-3">
                <label class="font-weight-bold">Saldo</label>
                <input type="text" name="vl_ecosaldo" id="saldo_usuario" class="form-control" placeholder="Saldo" readonly>
          </div>

          <label class="font-weight-bold">Valor final do Produto(€)</label>
          <div class="mb-3">
            <input type="text" id="valorFinal" name="vl_eco_total" class="form-control" placeholder="Valor Final" readonly>
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary font-weight-bold" name="cadastrarProdutoSaida" id="botaoFinalizar" disabled>Finalizar</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</main>

<script>
  function atualizarQuantidade_Valor(elemento) {
    const opcaoSelecionada = elemento.options[elemento.selectedIndex];
    const quantidade = opcaoSelecionada.getAttribute('data-produto');
    const valor = opcaoSelecionada.getAttribute('data-valor');
    const bloco = elemento.closest('.produto-bloco');
    bloco.querySelector('.valor-unitario').value = isNaN(valor) ? '' : '€ ' + parseFloat(valor).toFixed(2); 
    bloco.querySelector('.quantidade-linha').innerText = quantidade || 'Sem estoque';
    const quantidadeInput = bloco.querySelector('.quantidade');
    quantidadeInput.value = '';
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
    atualizaValorFinal();
  });

  function atualizarSaldoUsuario() {
    const usuario = document.getElementById('usuario');
    const opcaoSelecionada = usuario.options[usuario.selectedIndex];
    const saldo = opcaoSelecionada.getAttribute('data-saldo');
    document.getElementById('saldo_usuario').value = "€ " + parseFloat(saldo).toFixed(2);
    atualizaValorFinal();
  }

  function atualizaValorFinal() {
    let valorFinal = 0;
    document.querySelectorAll('.produto-bloco').forEach(bloco => {
      const valor = parseFloat(bloco.querySelector('.valor-unitario').value.split('€ ')[1]);
      const quantidade = parseFloat(bloco.querySelector('.quantidade').value);
      if (!isNaN(valor) && !isNaN(quantidade)) {
        valorFinal += valor * quantidade;
      }
    });
    document.getElementById('valorFinal').value = "€ " + valorFinal.toFixed(2);
    const saldoFormatado = parseFloat(document.getElementById('saldo_usuario').value.split("€ ")[1]);
    if (valorFinal > saldoFormatado || isNaN(saldoFormatado) || saldoFormatado <= 0) {
      document.getElementById("botaoFinalizar").setAttribute('disabled', 'disabled');
    } else {
      document.getElementById("botaoFinalizar").removeAttribute('disabled');
    }
  }

  function adicionarProduto() {
    const container = document.getElementById('produtoContainer');
    const bloco = document.querySelector('.produto-bloco');
    const novoBloco = bloco.cloneNode(true);
    novoBloco.querySelector('.quantidade-linha').innerText = 'Escolha um Produto';
    novoBloco.querySelector('.quantidade').value = '';
    novoBloco.querySelector('.quantidade').setAttribute('readonly', 'readonly');
    container.appendChild(novoBloco);
  }
</script> -->

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
          <div id="produtoContainer">
            <div class="produto-bloco">
              <div class="row">
                <div class="col-md-5">
                  <div class="mb-3">
                    <label class="font-weight-bold">Produto</label>
                    <select type="text" name="idProduto[]" class="form-control produto-select" onchange="atualizarQuantidade_Valor(this)"> 
                      <option value="">Selecione uma opção</option>
                      <?php if(isset($dados['produtos'])) { 
                        foreach($dados['produtos'] as $produto) { ?>
                          <option value="<?=$produto['id_produto'] ?>" data-produto="<?=$produto['qt_produto']?>" data-valor="<?=$produto['vl_eco'] ?>"> <?= $produto['nm_produto'] ?> - € <?= $produto['vl_eco'] ?></option>
                      <?php } } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="mb-3">
                    <label class="font-weight-bold">Quantidade (<span class="quantidade-linha">Escolha um Produto</span>)</label>
                    <input type="number" name="qt_produtoretirado[]" class="form-control quantidade" placeholder="Quantidade" oninput="atualizaValorFinal()" readonly>
                  </div>
                </div>
                <div class="col-md-1 d-flex align-items-end mb-3 ml-0">
                  <button type="button" class="btn btn-primary" onclick="adicionarProduto()">+</button>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="font-weight-bold">Usuário</label>
            <select type="number" name="idUsuario" id="usuario" class="form-control" onchange="atualizarSaldoUsuario()"> 
              <option value="">Selecione uma opção</option>
              <?php if(isset($dados['usuarios'])) { 
                foreach($dados['usuarios'] as $usuarios) { ?>
                  <option value="<?=$usuarios['id_usuario'] ?>" data-saldo="<?=$usuarios['vl_ecosaldo']?>"> <?= ucfirst($usuarios['nm_usuario']) ?> - CPF: <?=$usuarios['nu_cpf']?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="font-weight-bold">Saldo</label>
            <input type="text" name="vl_ecosaldo" id="saldo_usuario" class="form-control" placeholder="Saldo" readonly>
          </div>

          <label class="font-weight-bold">Valor final do Produto(€)</label>
          <div class="mb-3">
            <input type="text" id="valorFinal" name="vl_eco_total" class="form-control" placeholder="Valor Final" readonly>
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary font-weight-bold" name="cadastrarProdutoSaida" id="botaoFinalizar" disabled>Finalizar</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</main>

<script>
  function atualizarQuantidade_Valor(elemento) {
    const opcaoSelecionada = elemento.options[elemento.selectedIndex];
    const quantidade = opcaoSelecionada ? opcaoSelecionada.getAttribute('data-produto') : null;
    const valor = opcaoSelecionada ? opcaoSelecionada.getAttribute('data-valor') : null;
    const bloco = elemento.closest('.produto-bloco');
    const quantidadeLinha = bloco ? bloco.querySelector('.quantidade-linha') : null;
    const quantidadeInput = bloco ? bloco.querySelector('.quantidade') : null;
    const valorUnitario = bloco ? bloco.querySelector('.valor-unitario') : null;

    if (quantidadeLinha && quantidadeInput) {
      quantidadeLinha.innerText = quantidade || 'Sem estoque';
      quantidadeInput.value = '';
      quantidadeInput.max = quantidade || 0;
      quantidadeInput.readOnly = !(quantidade > 0);
    }
    
    if (valorUnitario) {
      valorUnitario.value = isNaN(valor) ? '' : '€ ' + parseFloat(valor).toFixed(2);
    }

    atualizaValorFinal();
  }

  function atualizarSaldoUsuario() {
    const usuario = document.getElementById('usuario');
    const opcaoSelecionada = usuario ? usuario.options[usuario.selectedIndex] : null;
    const saldo = opcaoSelecionada ? opcaoSelecionada.getAttribute('data-saldo') : null;
    const saldoUsuario = document.getElementById('saldo_usuario');

    if (saldoUsuario) {
      saldoUsuario.value = saldo ? "€ " + parseFloat(saldo).toFixed(2) : '';
    }

    atualizaValorFinal();
  }

  function atualizaValorFinal() {
    let valorFinal = 0;
    const produtoBlocos = document.querySelectorAll('.produto-bloco');
    
    produtoBlocos.forEach(bloco => {
      const valorUnitario = bloco.querySelector('.valor-unitario');
      const quantidadeInput = bloco.querySelector('.quantidade');
      const valor = valorUnitario ? parseFloat(valorUnitario.value.split('€ ')[1]) : 0;
      const quantidade = quantidadeInput ? parseFloat(quantidadeInput.value) : 0;

      if (!isNaN(valor) && !isNaN(quantidade)) {
        valorFinal += valor * quantidade;
      }
    });

    const valorFinalInput = document.getElementById('valorFinal');
    if (valorFinalInput) {
      valorFinalInput.value = "€ " + valorFinal.toFixed(2);
    }

    const saldoUsuario = document.getElementById('saldo_usuario');
    const saldoFormatado = saldoUsuario ? parseFloat(saldoUsuario.value.split("€ ")[1]) : 0;
    const botaoFinalizar = document.getElementById("botaoFinalizar");

    if (botaoFinalizar) {
      botaoFinalizar.disabled = valorFinal > saldoFormatado || isNaN(saldoFormatado) || saldoFormatado <= 0;
    }
  }

  function adicionarProduto() {
    const container = document.getElementById('produtoContainer');
    const bloco = document.querySelector('.produto-bloco');
    const novoBloco = bloco.cloneNode(true);

    if (novoBloco) {
      novoBloco.querySelector('.quantidade-linha').innerText = 'Escolha um Produto';
      const quantidadeInput = novoBloco.querySelector('.quantidade');
      const valorUnitario = novoBloco.querySelector('.valor-unitario');

      if (quantidadeInput) {
        quantidadeInput.value = '';
        quantidadeInput.setAttribute('readonly', 'readonly');
      }

      if (valorUnitario) {
        valorUnitario.value = '';
      }
      
      // Adicionar eventos novamente
      const selects = novoBloco.querySelectorAll('select');
      selects.forEach(select => {
        select.addEventListener('change', function() { atualizarQuantidade_Valor(this); });
      });

      const inputs = novoBloco.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('input', atualizaValorFinal);
      });

      container.appendChild(novoBloco);
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const quantidadeInputs = document.querySelectorAll('.quantidade');
    quantidadeInputs.forEach(input => {
      input.addEventListener('input', function() {
        const max = parseInt(this.max, 10);
        if (parseInt(this.value, 10) > max) {
          this.value = max;
        }
        atualizaValorFinal();
      });
    });
  });
</script>
