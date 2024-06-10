<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display 4 text-center text-primary">Recebimento de Material</h1>
        <?php
            
        if (!empty($data['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($data['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../material/cadastro_recebimento_material" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold">Usuário</label>
                <select type="number" name="usuario_id" id="categoria" class="form-control"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                       
                        if(isset($data['usuarios']))
                        { 
                            
                            foreach($data['usuarios'] as $usuarios)
                            { ?>
                            <option value="<?=$usuarios['id'] ?>" > <?= $usuarios['nome'] ?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                    </select>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold">Material</label>
                <select type="number" name="material_id" id="material" class="form-control" onchange="atualizarUnidade()"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                       
                        if(isset($data['materiais']))
                        { 
                            
                            foreach($data['materiais'] as $materiais)
                            { ?>
                            <option value="<?=$materiais['id'] ?>" data-unidade="<?=$materiais['unidade_medida']?>" data-eco_valor="<?=$materiais['eco_valor']?>"> <?= $materiais['name']?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                    </select>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold">Quantidade (<span id="unidade_linha"></span>)</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" oninput="atualizarValor()">
            </div>

            <div class="mb-3">
                <label class="font-weight-bold">Eco Points</label>
                <input type="text" name="eco_valor" id="valorFinal" class="form-control" oninput="atualizarValor()" readonly>
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrar_recebimento_material"  value="cadastrar-categoria">Enviar</button>
            </div>
        </form> 
        
      </div>
    </div>
  </div>
</main>

<script>
    function atualizarUnidade()
    {
        
        const material = document.getElementById('material');
        const opcaoSelecionada = material.options[material.selectedIndex];
        const unidadeMedida = opcaoSelecionada.getAttribute('data-unidade');
        document.getElementById('unidade_linha').innerText = unidadeMedida || 'Unidade de Medida';
        document.getElementById('quantidade').value = '';
        atualizarValor();   
    }

    function atualizarValor()
    {   
        const material = document.getElementById('material');
        const opcaoSelecionada = material.options[material.selectedIndex];
        const valor = opcaoSelecionada.getAttribute('data-eco_valor');
        const quantidade = document.getElementById('quantidade').value;
        const valorFinal = quantidade * valor;
        document.getElementById('valorFinal').value=isNaN(valorFinal) ? '' : valorFinal.toFixed(2);
    }
</script>