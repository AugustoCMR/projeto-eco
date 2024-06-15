<main>
  <div class="container">
  <h1 class="display-5 text-center text-primary titulo" style="margin-top:90px">Usuários</h1>
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

        <form class="form-inline my-4" action="../produto/consultarProdutos" method="POST" >
            <div class="mb-3 mr-5 text-center">
                <input type="text" name="produto" class="form-control" placeholder="Filtrar Usuários">
            </div>     
        </form>

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
              <td><?= $usuario['nm_usuario'] ?></td>
              <td><?= $usuario['nm_email'] ?></td>
              <td><?= $usuario['vl_ecosaldo'] ?></td>
              <td><?= $usuario['nu_cpf'] ?></td>
              <td><?= $usuario['nm_pais'] ?></td>
              <td><?= $usuario['nm_estado'] ?></td>
              <td><?= $usuario['nm_cidade'] ?></td>
              <td><?= $usuario['nu_cep'] ?></td>
              <td><?= $usuario['nm_rua'] ?></td>
              <td><?= $usuario['nm_bairro'] ?></td>
              <td><?= $usuario['nm_numero'] ?></td>
              <td>
                <button class='btn btn-success font-weight-bold' onclick="window.location.href='/projeto-eco/public/usuario/editar/<?=$usuario['id_usuario']?>'">Editar</button>
                <div class="container">
                <button class='btn btn-danger font-weight-bold mt-3' data-toggle="modal" data-target="#confirmDeleteModal">
                      Deletar Usuário
                </button>
              </div>
              <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              Tem certeza que deseja excluir este usuário?
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Deletar</button>
                          </div>
                      </div>
                  </div>
              </div>
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
   * Método para enviar o controller/método via URL
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    document.addEventListener("DOMContentLoaded", function() {
 
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
         
            var usuarioId = <?= $usuario['id_usuario'] ?>;
        
            window.location.href = '/projeto-eco/public/usuario/deletar/' + usuarioId;
        });
    });
</script>

