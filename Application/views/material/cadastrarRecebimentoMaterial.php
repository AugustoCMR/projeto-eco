<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:40px">
        <h1 class="display 4 text-center text-primary">Recebimento de Material</h1>
        <?php
            
        if (!empty($dados['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../material/cadastrarMaterialRecebido" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold">Usuário</label>
                <select type="number" name="idUsuario" id="categoria" class="form-control"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                       
                        if(isset($dados['usuarios']))
                        { 
                            
                            foreach($dados['usuarios'] as $usuarios)
                            { ?>
                            <option value="<?=$usuarios['id_usuario'] ?>" > <?= $usuarios['nm_usuario'] ?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                    </select>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold">Material</label>
                <select type="number" name="idMaterial" id="material" class="form-control" onchange="atualizarUnidade()"> 
                    <option value="">Selecione uma opção</option>
                    <?php 
                       
                        if(isset($dados['materiais']))
                        { 
                            
                            foreach($dados['materiais'] as $materiais)
                            { ?>
                            <option value="<?=$materiais['id_material'] ?>" data-unidade="<?=$materiais['nm_unidademedida']?>" data-eco_valor="<?=$materiais['vl_eco']?>"> <?= $materiais['nm_material']?></option> 
                            
                    <?php   } 
                        } ?> 
                    
                    </select>
            </div>

            <div class="mb-3">
                <label class="font-weight-bold">Quantidade (<span id="unidade_linha"></span>)</label>
                <input type="number" name="qt_materialentregue" id="quantidade" class="form-control" oninput="atualizarValor()">
            </div>

            <div class="mb-3">
                <label class="font-weight-bold">Eco Points</label>
                <input type="text" name="vl_eco" id="valorFinal" class="form-control" oninput="atualizarValor()" readonly>
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrarMaterialRecebido">Enviar</button>
            </div>
        </form> 
        
      </div>
    </div>
  </div>
</main>

<script>
     /**
   * Método para colocar a unidade de medida após o usuário selecionar o material
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    function atualizarUnidade()
    {
        
        const material = document.getElementById('material');
        const opcaoSelecionada = material.options[material.selectedIndex];
        const unidadeMedida = opcaoSelecionada.getAttribute('data-unidade');
        document.getElementById('unidade_linha').innerText = unidadeMedida || 'Unidade de Medida';
        document.getElementById('quantidade').value = '';
        atualizarValor();   
    }

    /**
   * Método para atualizar o valor após o usuário digitar a quantidade
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
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