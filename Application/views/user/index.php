<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h2>Usuários</h2>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Sobrenome</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['usuario'] as $usuarios) { ?>
            <tr>
              <td><?= $usuarios['nome'] ?></td>
              <td><?= $usuarios['sobrenome'] ?></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>