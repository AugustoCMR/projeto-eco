<h1 class="display-4 text-center text-primary font-weight-bold mt-5 titulo">Cadastrar Produto</h1>

<form method="POST" action="../produto/cadastrar_produto_sucesso" class="mt-5">

<div class="mb-3">
        <label class="font-weight-bold" style="margin: 0% 22%;">Produto</label>
        <input type="text" name="nome" style="width:700px; margin: 0% 22%;" class="form-control">

<div class="mb-3">
        <label class="font-weight-bold" style="margin: 1% 22%;">Eco Points</label>
        <input type="text" name="eco_valor" style="width:700px; margin: 0% 22%;" class="form-control">

        <div class="mb-3">
        <button type="submit" class= "btn btn-primary font-weight-bold" name="dados-categoria" style="width:700px; margin: 1% 22%;" value="cadastrar-categoria">Enviar</button>
    </div>
</form>