<?php
session_start();
include('BuscaLivros/buscaLivros.php');
include('buscaAutor/buscaAutor.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela home</title>

    <link rel="stylesheet" href="css_js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css_js/css/styleIndex.css">
    <link rel="stylesheet" href="css_js/css/styleCabecalho.css">
    <script src="css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <?php

        include('componentes/pgCabecalhoIndex.php');        

?>
    </header>
    <div class="container">
        <div class="carousel-container">

            <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="bannerIMG" src="img/img.teste.webp" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img class="bannerIMG" src="img/img.teste.webp" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img class="bannerIMG" src="img/img.teste.webp" class="d-block w-100" alt="...">
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

    <div class="containerLivrosRecomendados">
        <h4>Livros Recomendados</h4>
        <div class="containerLivroRecomendado">
            <?php
             include('componentes/componentesIndex/livrosRecomendados.php');
            ?>
        </div>
    </div>

    <div class="containerLivrosPopulares">
        <h4>Livros Populares</h4>
        <div class="containerLivroPopular">
            <?php
             include('componentes/componentesIndex/livrosPopulares.php');
            ?>
        </div>
    </div>

    <div class="containerAutores" style="margin-top: 80px;">
        <!--Autores em destaque-->
        <h4>Autores</h4>
        <div class="containerAutor">
            <?php
             include('componentes/componentesIndex/buscaAutor.php');
            ?>
        </div>
    </div>

    <div class="containerLivrosLancamentos">
        <h4>Lançamentos</h4>
        <div class="containerLivroLancamento">
            <?php
             include('componentes/componentesIndex/livrosLancamentos.php');
            ?>
        </div>
    </div>

    <div class="containerLivrosFavoritos">
        <h4>Sua lista</h4>
        <div class="containerAviso">
            <label style="color: white;">Quer salvar seus livros favorito?</label>
            <img src="./img/bookmark.png" class="imgFavorito" alt="Favorito">
            <label style="color: white;">Faça login para salvar seus livros</label>
            <div class="botao">
                <input type="submit" name="Criar conta" value="Fazer login">
            </div>
        </div>

    </div>

    <hr style="width: 100%; border-color: white;">
    <footer>
        <form style="width: 270px; height: 220px;">
            <div class="containerAviso">
                <img src="./img/Quanto_mais_você_lê_mais_você_voa__2_-removebg-preview.png" class="imgLogo" alt="Logo">
                <label style="color: white;">Quanto mais você le, mais você voa</label>
                <label style="color: white;">2025 - TCC ETEC</label>
            </div>
        </form>
    </footer>
</body>

</html>