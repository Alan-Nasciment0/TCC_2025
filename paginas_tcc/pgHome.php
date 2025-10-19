<?php
session_start();

include('../BuscaLivros/buscaLivros.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela home</title>

    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css_js/css/styleHome.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

    <header>

        <?php
        include('../componentes/pgCabecalhoPaginas.php');
        
        ?>

        <?php 
            $usuarioCod = $_SESSION['usuario_cod'];

            $sql = "SELECT COUNT(*) AS total FROM categoria_preferida_usuario WHERE usuario_cod = :usuario_cod";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario_cod', $usuarioCod, PDO::PARAM_INT);
            $stmt->execute();
            $resultadoCategoria = $stmt->fetch(PDO::FETCH_ASSOC); 

            $sql = "SELECT COUNT(*) AS total FROM genero_preferido_usuario WHERE usuario_cod = :usuario_cod";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario_cod', $usuarioCod, PDO::PARAM_INT);
            $stmt->execute();
            $resultadoGenero = $stmt->fetch(PDO::FETCH_ASSOC); 
            
        if ($resultadoCategoria['total'] == 0){?>        
        <div id="modalCategoria" class="modal-overlay">
            <div class="modal-content">
                <?php include(__DIR__ . '/pgCategoria.php'); ?>
            </div>
        </div>
        <script>
            // Fechar o modal ao clicar fora dele
            document.addEventListener('click', function (event) {
                const modal = document.getElementById('modalCategoria');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        </script>
        <?php
        }elseif ($resultadoGenero['total'] == 0){?>
        <div id="modalGenero" class="modal-overlay">
            <div class="modal-content">
                <?php include(__DIR__ . '/pgGenero.php'); ?>
            </div>
        </div>
        <script>
            // Fechar o modal ao clicar fora dele
            document.addEventListener('click', function (event) {
                const modal = document.getElementById('modalCategoria');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        </script>


        <?php unset($_SESSION['primeiro_acesso']); ?>
        <?php } ?>

    </header>
    <div class="container">
        <div class="carousel-container">

            <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="bannerIMG" src="../img/banner.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img class="bannerIMG" src="../img/img.teste.webp" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img class="bannerIMG" src="../img/img.teste.webp" class="d-block w-100" alt="...">
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
             include('../componentes/componentesPaginas_tcc/livrosRecomendados.php');
            ?>
        </div>
    </div>

    <div class="containerLivrosPopulares">
        <h4>Livros Populares</h4>
        <div class="containerLivroPopular">
            <?php
             include('../componentes/componentesPaginas_tcc/livrosPopulares.php');
            ?>
        </div>
    </div>

    <div class="containerAutores" style="margin-top: 80px;">
        <!--Autores em destaque-->
        <h4>Autores</h4>
        <div class="containerAutor">
            <div class="autor">
                <img class="autoresIMG" src="../img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="../img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="../img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="../img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="../img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>

            <div class="autor">
                <img class="autoresIMG" src="../img/autor.jpg" alt="autor">
                <h6>Machado de Assis</h6>
            </div>
        </div>

    </div>

    <div class="containerLivrosLancamentos">
        <h4>Lançamentos</h4>
        <div class="containerLivroLancamento">
            <?php
             include('../componentes/componentesPaginas_tcc/livrosLancamentos.php');
            ?>
        </div>
    </div>
</body>

</html>