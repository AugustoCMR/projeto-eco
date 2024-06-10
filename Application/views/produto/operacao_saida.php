

<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Operação de Saída</h1>
        


        <form method="POST" action="../produto/cadastrar_operacao_saida_produto_sucesso" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold" style="">Produto</label>
                <input type="text" style="" name="produto"    
                value="<?= isset($data['produto']) ? $data['produto'] : '' ?>" class="form-control" placeholder="Nome do Produto">
            </div>

            <label class="font-weight-bold" style="">Usuario</label>
            <div class="mb-3">
            <input type="text" style="" name="usuario"
            value="<?= isset($data['usuario']) ? $data['usuario'] : '' ?>" class="form-control" placeholder="Usuario">
            </div>
        
            <label class="font-weight-bold" style="">Quantidade</label>
            <div class="mb-3">
            <input type="text" style="" name="quantidade"
            value="<?= isset($data['quantidade']) ? $data['quantidade'] : '' ?>" class="form-control" placeholder="Quantidade">
            </div>


            <label class="font-weight-bold" style="">Valor</label>
            <div class="mb-3">
            <input type="text" style="" name="eco_valor"
            value="<?= isset($data['eco_valor']) ? $data['eco_valor'] : '' ?>" class="form-control" placeholder="Valor">
            </div>


            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="dados-categoria"  value="cadastrar-categoria">Enviar</button>
        </div>

           
        </form>
        
      </div>
    </div>
  </div>
</main>