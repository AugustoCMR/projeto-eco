<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="text-center">Cadastrar Usuário</h1>
        <?php 

        if (!empty($data['erros'])): 
            ?>
            <div class="alert alert-danger mt-5">
                <?php foreach ($data['erros'] as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../user/register_user" class="mt-5">
    
            <div class="mb-3">
                <label class="font-weight-bold" style="">Nome</label>
                <input type="text" style="" name="nome"    
                value="<?= isset($data['nome']) ? $data['nome'] : '' ?>" class="form-control" placeholder="Nome">
            </div>
        
            <label class="font-weight-bold" style="">Sobrenome</label>
            <div class="mb-3">
            <input type="text" style="" name="sobrenome"
            value="<?= isset($data['sobrenome']) ? $data['sobrenome'] : '' ?>" class="form-control" placeholder="Sobrenome">
            </div>

            <label class="font-weight-bold" style="">Email</label>
            <div class="mb-3">
            <input type="text" style="" name="email"
            value="<?= isset($data['email']) ? $data['email'] : '' ?>" class="form-control" placeholder="Email">
            </div>

            <label class="font-weight-bold" style="">CPF</label>
            <div class="mb-3">
            <input type="text" style="" name="cpf"
            value="<?= isset($data['cpf']) ? $data['cpf'] : '' ?>" class="form-control" placeholder="Digite apenas números">
            </div>

            <label class="font-weight-bold" style="">CEP</label>
            <div class="mb-3">
            <input type="text" style="" name="cep"
            value="<?= isset($data['cep']) ? $data['cep'] : '' ?>" class="form-control" placeholder="Digite apenas números">
            </div>

            <label class="font-weight-bold" style="">Rua</label>
            <div class="mb-3">
                <input type="text" style="" name="rua"
                value="<?= isset($data['rua']) ? $data['rua'] : '' ?>" class="form-control" placeholder="Rua">
            </div>

            <label class="font-weight-bold" style="">Bairro</label>
            <div class="mb-3">
                <input type="text" style="" name="Bairro" 
                value="<?= isset($data['bairro']) ? $data['bairro'] : '' ?>" class="form-control" placeholder="Bairro">
            </div>

            <label class="font-weight-bold" style="">Número</label>
            <div class="mb-3">
                <input type="text" style="" name="numero"
                value="<?= isset($data['numero']) ? $data['numero'] : '' ?>" class="form-control" placeholder="Número">
            </div>

            <div class="mb-3">
                <button type="submit" class= "btn btn-primary font-weight-bold" name="cadastro_usuario"  value="cadastro_usuario" style="">Enviar</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</main>