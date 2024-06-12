<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h2>Produtos</h2>

        <form class="form-inline my-4" action="../produto/consultar_produto" method="POST" >
            <div class="mb-3 mr-5 text-center">
                <input type="text" name="produto" class="form-control" placeholder="Filtrar Produto">
            </div>
            
            <div class="mb-3 " role="alert"> 
                <input type="number" name="quantidade" id="quantidade" class="form-control" placeholder="Simular Valores">
                <button id="btnCalcular" type="submit" name="submit_quantidade" class="btn btn-primary font-weight-bold" >Calcular</button>
            </div>
               
        </form>

        <div class="alert alert-primary font-weight-bold" role="alert">
          Cotação atual:
          € <?=$data['cotacao_eco']?> equivale a R$ <?= $data['cotacao_real']?> 
        </div>
    

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade em Estoque</th>
              <th id = "eco_valor_titulo" scope="col">Eco Points</th>
              <th id = "real_valor_titulo" scope="col">Valor</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['produto'] as $produto) { ?>
            <tr  data-produto-nome="<?= $produto['nome'] ?>">
              <td><?= $produto['id'] ?></td>
              <td><?= $produto['nome'] ?></td>
              <td><?= $produto['quantidade'] ?></td>
              <td id="eco_valor"><?= '€ ' . (isset($data['eco_valorTabela']) ? $produto['eco_valor'] * $data['eco_valorTabela'] : $produto['eco_valor'] * $data['cotacao_eco']); ?></td>
              <td id="real_valor"><?= 'R$ ' . (isset ($data['real_valorTabela']) ? $data['real_valorTabela'] * $produto['eco_valor'] : $produto['eco_valor'] * $data['cotacao_real']); ?></td>
              
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
