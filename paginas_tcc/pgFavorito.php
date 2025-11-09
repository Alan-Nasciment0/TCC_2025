<?php
session_start();
include('../conexao_bd_sql/conexao_bd_mysql.php'); // garante acesso ao PDO

$usuario_cod = $_SESSION['usuario_cod'] ?? null;

if (!$usuario_cod) {
    header('Location:pglogin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Favoritos</title>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleFavorito.css">
    <link rel="stylesheet" href="../css_js/css/styleContainerLivros.css">
</head>

<body>
    <header>

        <?php
        include('../componentes/pgCabecalhoPaginas.php');
        
        ?>

    </header>

    <div class="containerPrincipal">
        <div class="containerFavoritos">
            <div class="containerTitulo">
                <h2 class="titulo">Favoritos</h2>
            </div>
            <div class="containerAlinhamento">
                <div class="containerPesquisa">
                    <img src="../img/pesquisarBranco.png" class="imgPesquisa" alt="Pesquisar">
                    <input name="pesquisa" placeholder="Pesquisa de livro">
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
        </div>
        <div class="containerLivrosFavoritos">
            <?php
             include('../BuscaLivros/buscaLivrosFavoritos.php');
            ?>
        </div>
    </div>
</body>
</html>
