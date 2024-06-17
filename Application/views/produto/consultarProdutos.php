<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:99px">
        <h1 class="display-5 text-center text-primary titulo">Produtos</h1>

        <?php
        
          if (!empty($dados['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form class="form-inline my-4" action="../produto/consultarProdutos" method="POST" >
             
          <div class="mb-3 " role="alert"> 
                  <input type="number" name="quantidade" id="quantidade" class="form-control" placeholder="Digite a quantidade">
                  <button id="btnCalcular" type="submit" name="submit_quantidade" class="btn btn-primary font-weight-bold" >Calcular</button>
          </div>
               
        </form>

        <div class="alert alert-primary font-weight-bold" role="alert">
          Cotação atual:
          € <?=$dados['cotacao_eco']?> equivale a R$ <?= $dados['cotacao_real']?> 
        </div>
    

        <table class="table table-striped table-hover text-center">
          <thead class="thead-light">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade em Estoque</th>
              <th id = "eco_valor_titulo" scope="col">Eco Points</th>
              <th id = "real_valor_titulo" scope="col">Valor</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dados['produto'] as $produto) { ?>
            <tr  data-produto-nome="<?= $produto['nm_produto'] ?>">
              <td><?= $produto['id_produto'] ?></td>
              <td><?= ucfirst($produto['nm_produto']) ?></td>
              <td><?= $produto['qt_produto'] ?></td>
              <td id="eco_valor"><?= '€ ' . (isset($dados['quantidade']) ? $produto['vl_eco'] * $dados['quantidade'] : $produto['vl_eco']); ?></td>
              <td id="real_valor"><?= 'R$ ' . (isset ($dados['quantidade']) ? ($produto['vl_eco'] / $dados['cotacao_eco']) * $dados['quantidade'] : $produto['vl_eco'] / $dados['cotacao_eco']); ?></td>
              <td>
                <button class='btn btn-success font-weight-bold mb-3' onclick="window.location.href='/projeto-eco/public/produto/editar/<?=$produto['id_produto']?>'">Editar</button>
                <button class='btn btn-danger font-weight-bold delete-button mb-3' id="deletar" onclick="confirmarExclusao(<?=$produto['id_produto']?>)">Deletar</button>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
 </div>
</main>

<script>
     /**
   * Método para confirmar exclusão do produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param idProduto id do produto
   */
function confirmarExclusao(idProduto) {
  if (confirm('Tem certeza que deseja excluir?')) {
    location.href = '/projeto-eco/public/produto/deletar/' + idProduto;
  } else {

    return false;
  }
}
</script>
