<?php
session_start();
include('../BuscaLivros/buscaLivros.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela favorito</title>

    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleFavorito.css">
</head>

<body>
    <header>

        <?php
        include('../componentes/pgCabecalhoPaginas.php');
        
        ?>

    </header>

     

    <div class="containerLivrosRecomendados">
        <h4>Livros Recomendados</h4>
        <div class="containerLivroRecomendado">
            <?php
             include('../componentes/componentesPaginas_tcc/livrosRecomendados.php');
            ?>
        </div>
    </div>
</body>

</html>