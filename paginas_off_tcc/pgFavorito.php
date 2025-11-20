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
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">

</head>

<body>
    <header>

        <?php
        include('../componentes/componentesIndex/pgCabecalhoIndex.php');
        
        ?>

    </header>
    
    <div class="containerPrincipal">
        <div class="containerFavoritos">
            <div class="containerTitulo">
                <h2 class="titulo">Favoritos</h2>
            </div>            
        </div>
        
        <form style="width: 240px; height: 220px; margin-top: 10rem;">
            <div class="containerAviso">
                <label style="color: white;">Quer salvar seus livros favorito?</label>
                <img src="../img/bookmark.png" class="imgFavorito" alt="Favorito">
                <label style="color: white;">Faça login para salvar seus livros</label>
                <div class="botaoFazerLogin">
                <button type="submit" name="Criar conta" class="btn btn-light" value="Fazer login">Fazer Login</button>
            </div>
            </div>
        </form>
    </div>

    <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
    ?>
<script>
    document.querySelectorAll('.btn-light').forEach(btn => {
        btn.addEventListener('click', function () {
             window.location.href = '../paginas_tcc/pgLogin.php';
        });
    });
</script>

</body>

</html>