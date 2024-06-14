<main>
  <div class="container">
  <h1 class="display-5 text-center text-primary titulo" style="margin-top:90px">Usuários</h1>
    <div class="row">
    
      <div class="col-8 offset-2" style="margin-top:px">
        
        <form class="form-inline my-4" action="../material/consultarMateriais" method="POST" >
            <div class="mb-3 mr-5 text-center">
                <input type="text" name="produto" class="form-control" placeholder="Filtrar Usuários">
            </div>     
        </form>

        <table class="table table-striped table-hover">
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
                <button class='btn btn-success font-weight-bold'>Editar</button>
                <button class='btn btn-danger font-weight-bold mt-3'>Deletar</button>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
 </div>
</main>
