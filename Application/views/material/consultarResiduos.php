<main>
  <div class="container">
  <h1 class="display-5 text-center text-primary titulo mb-5" style="margin-top:90px">Resíduos</h1>
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
        
        <table class="table table-striped table-hover text-center">
          <thead class="thead-light">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Residuo</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dados['residuos'] as $residuo) { ?>
            <tr">
              <td><?= $residuo['id_residuo'] ?></td>
              <td><?= ucfirst($residuo['nm_residuo']) ?></td>
              <td>
                <button class='btn btn-success font-weight-bold mb-3' onclick="window.location.href='/projeto-eco/public/material/editarResiduo/<?=$residuo['id_residuo']?>'">Editar</button>
                <button class='btn btn-danger font-weight-bold delete-button mb-3' id="deletar" onclick="confirmarExclusao(<?=$residuo['id_residuo']?>)" >
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
function confirmarExclusao(idResiduo) {
  if (confirm('Tem certeza que deseja excluir?')) {
    location.href = '/projeto-eco/public/material/deletarResiduo/' + idResiduo;
  } else {

    return false;
  }
}
</script>