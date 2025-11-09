<?php
session_start();
include('../BuscaLivros/buscaLivros.php');

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
        include('../componentes/pgCabecalhoPaginas.php');
        
        ?>
    </header>
  <div class="tela">
    <!-- Barra superior -->

    <!-- Filtros -->
    <div class="filtros">
      <ul>
        <li><a href="#">Melhores avaliados ></a></li>
        <li><a href="#">Piores avaliados ></a></li>
      </ul>
    </div>

    <!-- Conteúdo -->
    <div class="conteudo">
      <div class="cartao">
        <div class="capa">
          <img src="../img/Reinações_de_Narizinho.webp" class="imagem-capa">
        </div>
        <div class="informacoes">
          <div class="titulo">1. A droga da obediência</div>
          <div class="autor">Pedro Bandeira</div>
          <div class="avaliacao">⭐ 4.5 (100 avaliações)</div>
        </div>
      </div>

      <div class="cartao">
        <div class="capa">
          <img src="../img/Reinações_de_Narizinho.webp" class="imagem-capa">
        </div>
        <div class="informacoes">
          <div class="titulo">2. O Senhor dos Anéis</div>
          <div class="autor">J.R.R. Tolkien</div>
          <div class="avaliacao">⭐ 5.0 (200 avaliações)</div>
        </div>
      </div>

      <div class="cartao">
        <div class="capa">
          <img src="../img/Reinações_de_Narizinho.webp" class="imagem-capa">
        </div>
        <div class="informacoes">
          <div class="titulo">3. Dom Casmurro</div>
          <div class="autor">Machado de Assis</div>
          <div class="avaliacao">⭐ 4.8 (150 avaliações)</div>
        </div>
      </div>
    </div>
  </div>
  <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
    ?>
</body>

</html>