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
                <img src="../img/pesquisarBranco.png" class="imgPesquisa" alt="Pesquisar">
                <input name="pesquisa" placeholder="Pesquisa de livro"
                    style="width: 200px; height: 26px; margin-top: 73px;">
            </div>

            <div class="containerFiltro">
                <div class="dropdown">
                    <img src="../img/filtro.png" class="imgFiltro" alt="Filtro">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filtro
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Mais antigos</a></li>
                        <li><a class="dropdown-item" href="#">Mais novos</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <form style="width: 240px; height: 220px; margin-top: 240px;">
            <div class="containerAviso">
                <label style="color: white;">Quer salvar seus livros favorito?</label>
                <img src="../img/bookmark.png" class="imgFavorito" alt="Favorito">
                <label style="color: white;">Faça login para salvar seus livros</label>
                <div class="botao">
                    <input type="submit" name="Criar conta" value="Fazer login">
                </div>
            </div>
        </form>
    </div>

</body>

</html>