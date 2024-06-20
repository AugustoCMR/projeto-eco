<main>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2" style="margin-top:100px">
        <h1 class="display-5 text-center text-primary mt-1 titulo">Ocorreu um erro, por favor, tente novamente 😢</h1>

        <div class="container text-center">

                <form method="POST" action="../home/index">
                    <div class="mt-5">
                            <button class="btn btn-primary mr-3" name="menu" value="inicio">
                                Voltar ao início
                            </button>

                     </div>
                </form>

                <p hidden><?php var_dump($dados['erro']) ?></p>
        </div>
        
        </div>
    </div>
  </div>
</main>

