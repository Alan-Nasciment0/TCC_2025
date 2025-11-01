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
        include('../componentes/pgCabecalhoIndex.php');
        
        ?>

    </header>
    <div class="containerPrincipal">
        <div class="containerFavorito">
            <h2 class="titulo">Favorito</h2>
            <div class="containerPesquisa">
                <img src="../img/pesquisarPreto.png" class="imgPesquisa">
                <input name="pesquisa" placeholder="Pesquisa de livro" style="width: 200px; height: 26px; margin-top: 73px; ">
            </div>
        </div>

    </div>
</body>

</html>