<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gêneros de Livros</title>
  <link rel="stylesheet" href="../css_js/css/styleGeneroLivro.css">
</head>

<body>
  <div class="container">
    <h2>Escolha seus gêneros favoritos de livros</h2>
    <p>Usamos seus gêneros favoritos para fazer melhores recomendações de livros e personalizar o que você vê em seu
      feed de atualizações.</p>

    <form action="../salvarPreferencias/salvarPreferencias.php" method="post">
    <div class="opcoes">
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="1"> Filosofia</label>
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="2"> Ciências Sociais</label>
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="3"> Comunismo e Socialismo</label>
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="4"> Psicologia</label>
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="5"> Finanças</label>
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="6"> Finanças Públicas</label>
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="7"> Economia Internacinal</label>
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="8"> Economia Ambienta</label>
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="9"> Macroeconomia</label>
      <label class="opcao"><input type="checkbox" name="generoPreferencia" value="10"> AutoAjuda</label>
    </div>

    <button class="btn" name="salvar_genero">Próxima página</button>
    </form>
  </div>
</body>

</html>