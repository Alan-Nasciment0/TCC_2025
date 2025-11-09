<?php
session_start();
include('../BuscaLivros/buscaLivros.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela historico</title>

    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleHistorico.css">
    <link rel="stylesheet" href="../css_js/css/styleContainerLivros.css">
</head>

<body>
    <header>

        <?php
        include('../componentes/pgCabecalhoPaginas.php');
        
        ?>

    </header>

    <div class="containerPrincipal">
        <div class="containerHistorico">
            <div class="containerTitulo">
                <h2 class="titulo">Historico</h2>
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
        <div class="containerLivrosHistoricoVisualizacao">
            <?php
             include('../componentes/componentesPaginas_tcc/livrosHistoricoVisualizacao.php');
            ?>
        </div>
    </div>
</body>

</html>