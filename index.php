<?php 
require 'conexao_bd_mysql.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela home</title>

  <link rel="stylesheet" href="./css_js/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="./css_js/css/home.css">
  <script src="./css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
  <header>
    <a href="paginas_tcc/pgCadastro.php">Clique Aqui</a>
  </header>
  <div class="container">
    <div class="carousel-container">
  
      <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
        <div class="carousel-inner">
          <div class="carousel-item active" >
            <img src="./img/" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item" >
            <img src="./img/" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item" >
            <img src="./img/" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>

  <div class="livros" style="margin-top: 80px;">
<!--Livros  Recomendados -->
  
    <div class="livro">
      <img class="marcador" src="../img/bookmark.png" alt="marcador" >
      <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
      <h6>Águas de homens  pretos</h6>
      <h6>Machado de Assis</h6>
    </div>

    <div class="livro">
      <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
      <h6>Águas de homens  pretos</h6>
      <h6>Machado de Assis</h6>
    </div>
    
    <div class="livro">
      <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
      <h6>Águas de homens  pretos</h6>
      <h6>Machado de Assis</h6>
    </div>

    <div class="livro">
      <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
      <h6>Águas de homens  pretos</h6>
      <h6>Machado de Assis</h6>
    </div>
  </div>

<div class="livros" style="margin-top: 80px;">
  <!--Livros Populares-->
    <div class="livro">
      <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
      <h6>Águas de homens  pretos</h6>
      <h6>Machado de Assis</h6>
    </div>
    
    <div class="livro">
      <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
      <h6>Águas de homens  pretos</h6>
      <h6>Machado de Assis</h6>
    </div>

    <div class="livro">
      <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
      <h6>Águas de homens  pretos</h6>
      <h6>Machado de Assis</h6>
    </div>

    <div class="livro">
      <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
      <h6>Águas de homens  pretos</h6>
      <h6>Machado de Assis</h6>
    </div>
  </div>  

  <div class="autores" style="margin-top: 80px;">
    <!--Autores em destaque-->
    <div class="autor">
      <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/Machado_de_Assis_1908.jpg" alt="autor">
      <h6>Machado de Assis</h6>
    </div>

    <div class="autor">
      <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/Machado_de_Assis_1908.jpg" alt="autor">
      <h6>Machado de Assis</h6>
    </div>

    <div class="autor">
      <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/Machado_de_Assis_1908.jpg" alt="autor">
      <h6>Machado de Assis</h6>
    </div>

    <div class="autor">
      <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/Machado_de_Assis_1908.jpg" alt="autor">
      <h6>Machado de Assis</h6>
    </div>

  </div>
  <div class="livros" style="margin-top: 80px;">
    <!--Livros Novos-->
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
        <h6>Águas de homens  pretos</h6>
        <h6>Machado de Assis</h6>
      </div>
      
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
        <h6>Águas de homens  pretos</h6>
        <h6>Machado de Assis</h6>
      </div>
  
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
        <h6>Águas de homens  pretos</h6>
        <h6>Machado de Assis</h6>
      </div>
  
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/41YhiinsnpL._SY445_SX342_.jpg" alt="livro">
        <h6>Águas de homens  pretos</h6>
        <h6>Machado de Assis</h6>
      </div>
  </div>
</body>

</html>