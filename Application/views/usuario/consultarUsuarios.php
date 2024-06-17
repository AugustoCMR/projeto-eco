<main>
  <div class="container">
  <h1 class="display-5 text-center text-primary titulo mb-5" style="margin-top:90px">Usuários</h1>
    <div class="row">
    
      <div class="col-8" style="margin-top:px">
        
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
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th id = "eco_valor_titulo" scope="col">Saldo</th>
              <th scope="col">CPF</th>
              <th scope="col">País</th>
              <th scope="col">Estado</th>
              <th scope="col">Cidade</th>
              <th scope="col">CEP</th>
              <th scope="col">Rua</th>
              <th scope="col">Bairro</th>
              <th scope="col">Número</th>
              <th scope="col">Ações</th> 
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dados['usuarios'] as $usuario) { ?>
            <tr">
              <td><?= $usuario['id_usuario'] ?></td>
              <td><?= ucfirst($usuario['nm_usuario']) ?></td>
              <td><?= $usuario['nm_email'] ?></td>
              <td><?= '€ ' . $usuario['vl_ecosaldo'] ?></td>
              <td><?= $usuario['nu_cpf'] ?></td>
              <td><?= ucfirst($usuario['nm_pais']) ?></td>
              <td><?= ucfirst($usuario['nm_estado']) ?></td>
              <td><?= ucfirst($usuario['nm_cidade']) ?></td>
              <td><?= $usuario['nu_cep'] ?></td>
              <td><?= ucfirst($usuario['nm_rua']) ?></td>
              <td><?= ucfirst($usuario['nm_bairro']) ?></td>
              <td><?= $usuario['nm_numero'] ?></td>
              <td>
                <button class='btn btn-success font-weight-bold' onclick="window.location.href='/projeto-eco/public/usuario/editar/<?=$usuario['id_usuario']?>'">Editar</button>
                <button class='btn btn-danger font-weight-bold delete-button mt-3' id="deletar" onclick="confirmarExclusao(<?=$usuario['id_usuario']?>)">
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
function confirmarExclusao(idProduto) {
  if (confirm('Tem certeza que deseja excluir?')) {
    location.href = '/projeto-eco/public/usuario/deletar/' + idProduto;
  } else {

    return false;
  }
}
</script>

