<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:50px">
        <h1 class="display 2 text-center text-primary mt-5 titulo">Atualizar Produto</h1>
        <?php
            
        if (!empty($dados['erros'])): 
            ?>  
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php $produto = $dados['produto'][0]?>
        <form method="POST" action="/projeto-eco/public/produto/editar" class="mt-5">

        <div class="mb-3">
                <label class="font-weight-bold">Produto</label>
                <input type="text" name="nm_produto" class="form-control"value="<?= ucfirst($produto['nm_produto'])?>">
        </div>
        <div class="mb-3">
                <label class="font-weight-bold">Eco Points</label>
                <input type="text" name="vl_eco" class="form-control"
                value="<?= $produto['vl_eco']?>" oninput="formatarValor(this)">
        </div>

        <div class="mb-3">
                <label class="font-weight-bold">Quantidade</label>
                <input type="number" name="qt_produto" class="form-control"
                value="<?= $produto['qt_produto']?>" readonly>
        </div>

        <div class="mb-3 d-flex justify-content-between flex-row-reverse">
            <button type="submit" class="btn btn-primary font-weight-bold" name="editarProduto" value="<?=$produto['id_produto']?>">Enviar</button>
            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.location.href='/projeto-eco/public/produto/consultarProdutos'">Retornar</button>
        </div> 

        </form>
        
      </div>
    </div>
  </div>
</main>

<script>
function formatarValor(input) {
   
    let valor = input.value.replace(/\D/g, '');

    if (valor.length > 0) {
     
        valor = (parseFloat(valor) / 100).toFixed(2).replace('.', ',');

        input.value = valor;
    } else {
        input.value = '';
    }
}
</script>




