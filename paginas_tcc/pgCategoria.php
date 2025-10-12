<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categoria de Livros</title>
  <link rel="stylesheet" href="../css_js/css/styleCategoriaLivro.css">
</head>

<body>
  <div class="container">
    <h2>Escolha sua categoria favoritos de livros</h2>
    <p>Usamos sua categoria favorita para fazer melhores recomendações de livros e personalizar o que você vê em seu
      feed de atualizações.</p>

    <form action="../salvarPreferencias/salvarPreferencias.php" method="post">
      <div class="opcoes">
        <label class="opcao"><input type="checkbox" name="categoriaPreferencia" value="1"> Ficção</label>
        <label class="opcao"><input type="checkbox" name="categoriaPreferencia" value="3"> Poesia</label>
        <label class="opcao"><input type="checkbox" name="categoriaPreferencia" value="2"> Não ficção</label>
        <label class="opcao"><input type="checkbox" name="categoriaPreferencia" value="4"> Infantil</label>
      </div>

      <button class="btn" name="salvar_categoria">Próxima página</button>
    </form>
  </div>

</body>

</html>