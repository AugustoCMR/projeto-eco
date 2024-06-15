<main>
  <div class="container">
  <h1 class="display-5 text-center text-primary titulo" style="margin-top:90px">Materiais</h1>
    <div class="row">
    
      <div class="col-8 offset-2" style="margin-top:px">

      <?php
      
      if (!empty($dados['erros'])): 
          ?>
          <div class="alert alert-danger mt-5">
              <?php foreach ($dados['erros'] as $erro): ?>
                  <p><?php echo $erro; ?></p>
              <?php endforeach; ?>
          </div>
      <?php endif; ?>
        
        <form class="form-inline my-4" action="/projeto-eco/public/material/consultarMateriais" method="POST" >
            <div class="mb-3 mr-5 text-center">
                <input type="text" name="produto" class="form-control" placeholder="Filtrar Usuários">
            </div>     
        </form>

        <table class="table table-striped table-hover text-center">
          <thead class="thead-light">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Unidade de Medida</th>
              <th id = "eco_valor_titulo" scope="col">Eco Points</th>
              <th scope="col">Tipo de Resíduo</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dados['materiais'] as $material) { ?>
            <tr">
              <td><?= $material['id_material'] ?></td>
              <td><?= $material['nm_material'] ?></td>
              <td><?= $material['nm_unidademedida'] ?></td>
              <td><?= $material['vl_eco'] ?></td>
              <td><?= $material['id_residuo'] ?></td>
              <td>
                <button class='btn btn-success font-weight-bold' onclick="window.location.href='/projeto-eco/public/material/editarMaterial/<?=$material['id_material']?>'">Editar</button>
                <button class='btn btn-danger font-weight-bold delete-button' id="deletar" onclick="confirmarExclusao(<?=$material['id_material']?>)" >
                  Deletar
                </button>
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
function confirmarExclusao(idMaterial) {
  if (confirm('Tem certeza que deseja excluir?')) {
    location.href = '/projeto-eco/public/material/deletarMaterial/' + idMaterial;
  } else {

    return false;
  }
}
</script>