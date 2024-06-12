<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h2>Produtos</h2>

        <form class="form-inline my-4" action="../produto/consultar_produto" method="POST" >
            <div class="mb-3 mr-5">
                <label class="font-weight-bold">Filtrar Produto</label>
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
              <label class="font-weight-bold">Simular Valores</label>
                <input type="text" name="quantidade" id="quantidade" class="form-control" placeholder="Quantidade">
               
            </div>
            <button onclick="atualizarValor()" id="btnCalcular" type="submit" name="submit_quantidade" class="btn btn-primary font-weight-bold ml-2" >Calcular</button>
            
        </form>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade em Estoque</th>
              <th id = "eco_valor_titulo" scope="col">Eco Points (Valor Unitário)</th>
              <th id = "real_valor_titulo" scope="col">Valor (Valor Unitário)</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['produto'] as $produto) { ?>
            <tr>
              <td><?= $produto['id'] ?></td>
              <td><?= $produto['nome'] ?></td>
              <td><?= $produto['quantidade'] ?></td>
              <td id="eco_valor"><?= '€ ', $produto['eco_valor'] ?></td>
              <td id="real_valor"><?= 'R$ ', $data['real'] * $produto['eco_valor']?></td>
              
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<script>
  // document.getElementById('btnCalcular').addEventListener('click', function(event)
  // {
  //   event.preventDefault();
    
  //   let quantidade = document.getElementById("quantidade").value;

  //   document.getElementById("eco_valor_titulo").innerText = "Eco Points (" + quantidade + ")";
  //   document.getElementById("real_valor_titulo").innerText = "Valor (" + quantidade + ")";

  // });

  function atualizarValor()
  {
    // event.preventDefault();

    let quantidade = document.getElementById("quantidade").value;

    document.getElementById("eco_valor_titulo").innerText = "Eco Points (" + quantidade + ")";
    document.getElementById("real_valor_titulo").innerText = "Valor (" + quantidade + ")";

  }
</script>