<?php

include('../BuscaLivros/buscaLivrosRanking.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ranking de Livros</title>

  <link rel="stylesheet" href="../css_js/css/styleRanking.css">
  <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
  <link rel="stylesheet" href="../css_js/css/styleRodape.css">
  <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
  <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>
  <header>
    <?php
        include('../componentes/componentesIndex/pgCabecalhoIndex.php');
        
        ?>
  </header>
  <div class="tela">
    <div class="containerTitulo">
      <h1 class="titulo">Melhores Livros já avaliados</h1>
      <h4 class="subTitulo">Confira a lista dos livros mais bem avaliados</h4>
    </div>
    <div class="conteudo">
      <?php
        include('../componentes/componentesPaginas_tcc/rankingLivros.php');
    ?>
    </div>
  </div>
  <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
    ?>
</body>

</html>