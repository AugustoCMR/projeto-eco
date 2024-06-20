<main>
  <div class="container">
    <div class="row">
      <div class="col-10 offset-1" style="margin-top:50px">
        <h1 class="display 4 text-center text-primary mt-5 titulo">Recebimento de Material</h1>
        <?php if (!empty($dados['erros'])):?>  
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form id="materialForm" class="mt-5" action="/projeto-eco/public/material/cadastrarMaterialRecebido" method="POST">
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label class="font-weight-bold">Usuário</label>
                <select name="idUsuario" id="usuario" class="form-control" <?php echo isset($dados['nm_usuario']) ? 'disabled' : ''; ?> > 
                    <option value="<?= isset($dados['id_usuario']) ? $dados['id_usuario'] : '' ?>"><?= isset($dados['nm_usuario']) ? $dados['nm_usuario'] : 'Selecione uma opção' ?></option>
                    <?php if (isset($dados['usuarios'])): ?>
                        <?php foreach ($dados['usuarios'] as $usuarios): ?>
                            <option value="<?=$usuarios['id_usuario'] ?>"> <?= ucfirst($usuarios['nm_usuario']) ?> - CPF: <?=$usuarios['nu_cpf']?></option> 
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="font-weight-bold">Material</label>
                <select name="idMaterial" id="material" class="form-control" onchange="atualizarUnidade()"> 
                    <option value="">Selecione uma opção</option>
                    <?php if (isset($dados['materiais'])): ?>
                        <?php foreach ($dados['materiais'] as $materiais): ?>
                            <option value="<?=$materiais['id_material'] ?>" data-unidade="<?=$materiais['nm_unidademedida']?>" data-eco_valor="<?=$materiais['vl_eco']?>"> <?= $materiais['nm_material']?></option> 
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold">Quantidade (<span id="unidade_linha"></span>)</label>
                <input type="number" name="qt_materialentregue" id="quantidade" class="form-control" oninput="atualizarValor()">
            </div>

            <div class="mb-3">
                <label class="font-weight-bold">Eco Points</label>
                <input type="text" name="vl_eco" id="valorFinal" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-primary font-weight-bold" onclick="adicionarMaterial()">Adicionar</button>
                <button type="submit" class="btn btn-primary font-weight-bold" name="cadastrarMaterialRecebido">Finalizar Cadastro</button>
            </div>
        </div>
        <div class="col-md-8 tabela-responsiva" style="max-height: 350px; overflow-y:auto;">
            <table class="table mt-5" id="materiaisAdicionados">
                <thead>
                    <tr>
                        <th style="display:none;">ID Usuário</th> 
                        <th style="display:none;">ID Material</th> 
                        <th>Usuário</th>
                        <th>Material</th>
                        <th>Quantidade</th>
                        <th>Eco Points</th>
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
    function atualizarUnidade() {
        const material = document.getElementById('material');
        const opcaoSelecionada = material.options[material.selectedIndex];
        const unidadeMedida = opcaoSelecionada.getAttribute('data-unidade');
        document.getElementById('unidade_linha').innerText = unidadeMedida || 'Unidade de Medida';
        document.getElementById('quantidade').value = '';
        atualizarValor();   
    }

    function atualizarValor() {   
        const material = document.getElementById('material');
        const opcaoSelecionada = material.options[material.selectedIndex];
        const valor = opcaoSelecionada.getAttribute('data-eco_valor');
        const quantidade = document.getElementById('quantidade').value;
        const valorFinal = quantidade * valor;
        document.getElementById('valorFinal').value = isNaN(valorFinal) ? '' : valorFinal.toFixed(2);
    }

    function adicionarMaterial() {
    const usuarioSelect = document.getElementById('usuario');
    const materialSelect = document.getElementById('material');
    const quantidade = document.getElementById('quantidade').value;
    const valorFinal = document.getElementById('valorFinal').value;

    if (!usuarioSelect.value || !materialSelect.value || !quantidade || !valorFinal) {
        alert('Preencha todos os campos antes de adicionar.');
        return;
    }

    const usuarioText = usuarioSelect.options[usuarioSelect.selectedIndex].text;
    const materialText = materialSelect.options[materialSelect.selectedIndex].text;
    const idUsuario = usuarioSelect.value;
    const idMaterial = materialSelect.value;
    const tbody = document.getElementById('materiaisAdicionados').querySelector('tbody');

    for (let row of tbody.children) 
    {
        if (row.children[1].innerText === idMaterial) 
        {
            alert('Este material já foi adicionado.');
            return;
        }
    }

    if(quantidade <= 0)
    {
        alert('Quantidade não pode ser menor que um');
        return;
    }

    const row = document.createElement('tr');
    row.innerHTML = `<td style="display:none;">${idUsuario}</td>
        <td style="display:none;">${idMaterial}</td>
        <td>${usuarioText}</td>
        <td>${materialText}</td>
        <td>${quantidade}</td>
        <td>${valorFinal}</td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removerMaterial(this)">-</button></td>`;
    tbody.appendChild(row);

    usuarioSelect.disabled = true;
    materialSelect.value = '';
    document.getElementById('quantidade').value = '';
    document.getElementById('valorFinal').value = '';
    document.getElementById('unidade_linha').innerText = '';

    atualizarDadosTabela();
    }

    function atualizarDadosTabela() {
        const tbody = document.getElementById('materiaisAdicionados').querySelector('tbody');
        const dados = [];

        for (let row of tbody.children) {
            const idUsuario = row.children[0].innerText; 
            const idMaterial = row.children[1].innerText; 
            const nm_usuario = row.children[2].innerText;
            const quantidade = row.children[4].innerText;
            const valorFinal = row.children[5].innerText;

            const item = {
                idUsuario: idUsuario,
                idMaterial: idMaterial,
                quantidade: quantidade,
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
    });

</script>
