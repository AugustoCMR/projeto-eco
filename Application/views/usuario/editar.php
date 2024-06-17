<main>

  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:50px">
        <h1 class="display 4 text-center text-primary mt-5 titulo">Editar Usuário</h1>
        
        <?php if (!empty($dados['erros'])): ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php $usuario = $dados["usuario"][0];?>

        <form method="POST" action="/projeto-eco/public/usuario/editar" class="mt-5">
          <div class="row">
            
            <div class="col-md-6">
              <div class="mb-3">
                <label class="font-weight-bold">Nome</label>
                <input type="text" name="nm_usuario"    
                value="<?= isset($usuario['nm_usuario']) ? ucfirst($usuario['nm_usuario']) : '' ?>" class="form-control" placeholder="Nome">
              </div>

              <div class="mb-3">
                <label class="font-weight-bold">Email</label>
                <input type="text" name="nm_email"
                value="<?= isset($usuario['nm_email']) ? $usuario['nm_email'] : '' ?>" class="form-control" placeholder="Email">
              </div>

              <div class="mb-3">
                <label class="font-weight-bold">CPF</label>
                <input type="text" name="nu_cpf"
                value="<?= isset($usuario['nu_cpf']) ? $usuario['nu_cpf'] : '' ?>" class="form-control" placeholder="Digite apenas números" readonly>
              </div>

              <div class="mb-3">
                <label class="font-weight-bold">País</label>
                <input type="text" name="nm_pais"
                value="<?= isset($usuario['nm_pais']) ? ucfirst($usuario['nm_pais']) : '' ?>" class="form-control" placeholder="País">
              </div>

              <div class="mb-3">
                <label class="font-weight-bold">Estado</label>
                <input type="text" name="nm_estado"
                value="<?= isset($usuario['nm_estado']) ? ucfirst($usuario['nm_estado']) : '' ?>" class="form-control" placeholder="Estado">
              </div>
            </div>

           
            <div class="col-md-6">
              <div class="mb-3">
                <label class="font-weight-bold">Cidade</label>
                <input type="text" name="nm_cidade"
                value="<?= isset($usuario['nm_cidade']) ? ucfirst($usuario['nm_cidade']) : '' ?>" class="form-control" placeholder="Cidade">
              </div>

              <div class="mb-3">
                <label class="font-weight-bold">CEP</label>
                <input type="text" name="nu_cep"
                value="<?= isset($usuario['nu_cep']) ? $usuario['nu_cep'] : '' ?>" class="form-control" placeholder="Digite apenas números">
              </div>

              <div class="mb-3">
                <label class="font-weight-bold">Rua</label>
                <input type="text" name="nm_rua"
                value="<?= isset($usuario['nm_rua']) ? ucfirst($usuario['nm_rua']) : '' ?>" class="form-control" placeholder="Rua">
              </div>

              <div class="mb-3">
                <label class="font-weight-bold">Bairro</label>
                <input type="text" name="nm_bairro" 
                value="<?= isset($usuario['nm_bairro']) ? ucfirst($usuario['nm_bairro']) : '' ?>" class="form-control" placeholder="Bairro">
              </div>

              <div class="mb-3">
                <label class="font-weight-bold">Número</label>
                <input type="text" name="nm_numero"
                value="<?= isset($usuario['nm_numero']) ? $usuario['nm_numero'] : '' ?>" class="form-control" placeholder="Número">
              </div>
            </div>
          </div>

          <div class="mb-3 d-flex justify-content-between flex-row-reverse">
            <button type="submit" class="btn btn-primary font-weight-bold" name="editarUsuario" value="<?=$usuario['id_usuario']?>">Enviar</button>
            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.location.href='/projeto-eco/public/usuario/consultarUsuarios'">Retornar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

