<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="text-center text-primary">Cadastrar Usuário</h1>
        <?php 

        if (!empty($dados['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($dados['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../usuario/cadastrar" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold">Nome</label>
                <input type="text" name="nm_usuario"    
                value="<?= isset($dados['nm_nome']) ? $dados['nm_nome'] : '' ?>" class="form-control" placeholder="Nome">
            </div>

            <label class="font-weight-bold">Email</label>
            <div class="mb-3">
            <input type="text" name="nm_email"
            value="<?= isset($dados['nm_email']) ? $dados['nm_email'] : '' ?>" class="form-control" placeholder="Email">
            </div>

            <label class="font-weight-bold">CPF</label>
            <div class="mb-3">
            <input type="text" name="nu_cpf"
            value="<?= isset($dados['nu_cpf']) ? $dados['nu_cpf'] : '' ?>" class="form-control" placeholder="Digite apenas números">
            </div>

            <label class="font-weight-bold">País</label>
            <div class="mb-3">
                <input type="text" name="nm_pais"
                value="<?= isset($dados['nm_pais']) ? $dados['nm_pais'] : '' ?>" class="form-control" placeholder="País">
            </div>

            <label class="font-weight-bold">Estado</label>
            <div class="mb-3">
                <input type="text" name="nm_estado"
                value="<?= isset($dados['nm_estado']) ? $dados['nm_estado'] : '' ?>" class="form-control" placeholder="Estado">
            </div>

            <label class="font-weight-bold">Cidade</label>
            <div class="mb-3">
                <input type="text" name="nm_cidade"
                value="<?= isset($dados['nm_cidade']) ? $dados['nm_cidade'] : '' ?>" class="form-control" placeholder="Cidade">
            </div>

            <label class="font-weight-bold">CEP</label>
            <div class="mb-3">
            <input type="text" name="nu_cep"
            value="<?= isset($dados['nu_cep']) ? $dados['nu_cep'] : '' ?>" class="form-control" placeholder="Digite apenas números">
            </div>

            <label class="font-weight-bold">Rua</label>
            <div class="mb-3">
                <input type="text" name="nm_rua"
                value="<?= isset($dados['nm_rua']) ? $dados['nm_rua'] : '' ?>" class="form-control" placeholder="Rua">
            </div>

            <label class="font-weight-bold">Bairro</label>
            <div class="mb-3">
                <input type="text" name="nm_bairro" 
                value="<?= isset($dados['nm_bairro']) ? $dados['nm_bairro'] : '' ?>" class="form-control" placeholder="Bairro">
            </div>

            <label class="font-weight-bold">Número</label>
            <div class="mb-3">
                <input type="text" name="nm_numero"
                value="<?= isset($dados['nm_numero']) ? $dados['nm_numero'] : '' ?>" class="form-control" placeholder="Número">
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastrarUsuario"  value="cadastro_usuario">Enviar</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</main>