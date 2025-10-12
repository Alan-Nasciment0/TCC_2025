<?php

include('BuscaLivros/buscaLivros.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela home</title>

    <link rel="stylesheet" href="css_js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css_js/css/styleIndex.css">
    <script src="css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <iframe name="iframe_cabecalho" src="componentes/pgCabecalho.php" frameborder="0"
            style="position: relative; width: 100%; height: 77px;" id="iframe_cabecalho"></iframe>
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
            <?php if (count($livros) > 0): ?>
            <?php foreach ($livros as $livro): ?>
            <div class="livro">
                <img src="<?= htmlspecialchars($livro['livro_capa_link']) ?>" class="imgLivro">
                <div class="gradiente"></div>
                <a class="marcador"><img src="img/bookmark.png" class="imgMarcador"></a>
                <h6 class="nomeLivro">
                    <?= htmlspecialchars($livro['livro_titulo']) ?>
                </h6>
                <h6 class="nomeAutor">Machado de Assis</h6>
                <div class="avaliacoes">
                    <img src="img/star.png" class="imgEstrela">
                    <h6 class="mediaAvaliacao">4,1</h6>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="containerLivrosPopulares">
        <h4>Livros Populares</h4>
        <div class="containerLivroPopular">
            <?php if (count($livros) > 0): ?>
            <?php foreach ($livros as $livro): ?>
            <div class="livro">
                <img src="<?= htmlspecialchars($livro['livro_capa_link']) ?>" class="imgLivro">
                <div class="gradiente"></div>
                <a class="marcador"><img src="img/bookmark.png" class="imgMarcador"></a>
                <h6 class="nomeLivro">
                    <?= htmlspecialchars($livro['livro_titulo']) ?>
                </h6>
                <h6 class="nomeAutor">Machado de Assis</h6>
                <div class="avaliacoes">
                    <img src="img/star.png" class="imgEstrela">
                    <h6 class="mediaAvaliacao">4,1</h6>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="containerAutores" style="margin-top: 80px;">
        <!--Autores em destaque-->
        <h4>Autores</h4>
        <div class="containerAutor">
            <div class="autor">
                <img class="autoresIMG" src="img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>
        </div>

    </div>

    <div class="containerLivrosLancamentos">
        <h4>Lançamentos</h4>
        <div class="containerLivroLancamento">
            <?php if (count($livros) > 0): ?>
            <?php foreach ($livros as $livro): ?>
            <div class="livro">
                <img src="<?= htmlspecialchars($livro['livro_capa_link']) ?>" class="imgLivro">
                <div class="gradiente"></div>
                <a class="marcador"><img src="img/bookmark.png" class="imgMarcador"></a>
                <h6 class="nomeLivro">
                    <?= htmlspecialchars($livro['livro_titulo']) ?>
                </h6>
                <h6 class="nomeAutor">Machado de Assis</h6>
                <div class="avaliacoes">
                    <img src="img/star.png" class="imgEstrela">
                    <h6 class="mediaAvaliacao">4,1</h6>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>