

<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Cadastrar Produto</h1>
        


        <form method="POST" action="../produto/cadastrar_produto_sucesso" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold" style="">Produto</label>
                <input type="text" style="" name="nome"    
                value="<?= isset($data['nome']) ? $data['nome'] : '' ?>" class="form-control" placeholder="Nome">
            </div>
        
            <label class="font-weight-bold" style="">Eco Points</label>
            <div class="mb-3">
            <input type="text" style="" name="eco_valor"
            value="<?= isset($data['eco_valor']) ? $data['eco_valor'] : '' ?>" class="form-control" placeholder="Eco Points">
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrar-produto"  value="cadastrar-produto">Enviar</button>
        </div>

           
        </form>
        
      </div>
    </div>
  </div>
</main>