<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h2>Produtos</h2>

        <form class="form-inline my-4" action="../produto/consultar_produto" method="POST" >
            <div class="mb-3 mr-5">
                <select type="number" name="produto_id" id="categoria" class="form-control"> 
                <option value="">Selecione uma opção</option>
                <?php 
                    if(isset($data['produto']))
                    { 
                        foreach($data['produto'] as $produto)
                        { ?>
                        <option value="<?=$produto['id'] ?>" > <?= $produto['nome'] ?></option> 
                        
                <?php   } 
                    } ?> 
                
                </select>
            </div>
            <div class="mb-3" role="alert"> 
                
                <input type="text" name="quantidade" class="form-control" placeholder="Quantidade">
            </div>
            <button type="submit" name="submit_quantidade" class="btn btn-primary font-weight-bold ml-2 mb-3" >Calcular</button>
        </form>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Eco Points</th>
              <th scope="col">Valor</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['dados'] as $produto) { ?>
            <tr>
              <td><?= $produto['id'] ?></td>
              <td><?= $produto['nome'] ?></td>
              <td><?= '€ ', $produto['eco_valor'] ?></td>
              <td><?= 'R$ ', $data['real'] * $produto['eco_valor']?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>