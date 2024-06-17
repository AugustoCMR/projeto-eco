<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:50px">
        <h1 class="display 2 text-center text-primary mt-5 titulo">Cadastrar Produto</h1>
        <?php
            
        if (!empty($dados['erros'])): 
            ?>  
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        
        <form method="POST" action="../produto/cadastrar" class="mt-5">

        <div class="mb-3">
                <label class="font-weight-bold">Produto</label>
                <input type="text" name="nm_produto" class="form-control">
        </div>
        <div class="mb-3">
                <label class="font-weight-bold">Eco Points(Valor Unitário)</label>
                <input type="text" name="vl_eco" class="form-control" oninput="formatarValor(this)">
        </div>

        <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrarProduto" value="cadastrar-categoria">Enviar</button>
        </div>  

        </form>
        
      </div>
    </div>
  </div>
</main>

<script>
function formatarValor(input) {
   
    let valor = input.value.replace(/\D/g, '');

    valor = valor.replace(/(\d+)(\d{2})$/, "$1,$2");

    valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

    input.value = valor;
}
</script>