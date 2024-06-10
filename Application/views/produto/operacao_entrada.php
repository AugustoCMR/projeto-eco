


<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Operação de Entrada</h1>
        


        <form method="POST" action="../produto/cadastrar_operacao_entrada_produto_sucesso" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold" style="">Produto</label>
                <input type="text" style="" name="nome"    
                value="<?= isset($data['nome']) ? $data['nome'] : '' ?>" class="form-control" placeholder="Nome do Produto">
            </div>
        
            <label class="font-weight-bold" style="">Quantidade</label>
            <div class="mb-3">
            <input type="text" style="" name="quantidade"
            value="<?= isset($data['quantidade']) ? $data['quantidade'] : '' ?>" class="form-control" placeholder="Quantidade">
            </div>


            <label class="font-weight-bold" style="">Valor</label>
            <div class="mb-3">
            <input type="text" style="" name="real_valor"
            value="<?= isset($data['real_valor']) ? $data['real_valor'] : '' ?>" class="form-control" placeholder="Valor">
            </div>


            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="dados-categoria"  value="cadastrar-categoria">Enviar</button>
        </div>

           
        </form>
        
      </div>
    </div>
  </div>
</main>