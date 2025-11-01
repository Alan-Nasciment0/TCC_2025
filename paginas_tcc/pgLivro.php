<?php
session_start();

include('../BuscaLivros/buscaLivros.php');

$livro_cod =  $_POST['cod_livro_selecionado']; 
$livro_titulo =  $_POST['livro_titulo_selecionado'];
$livro_capa = $_POST['livro_capa_selecionado'];
$livro_editora = $_POST['livro_editora_selecionado'];
$livro_descricao =  $_POST['livro_descricao_selecionado'];
$livro_autor =  $_POST['autor_nome_selecionado'];
$livro_genero =  $_POST['genero_nome_selecionado'];
$livro_ano =  $_POST['livro_ano_selecionado'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Livro</title>
    <link rel="stylesheet" href="../css_js/css/styleLivro.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body
    style="width: 100%;height: auto; display: flex; flex-direction: column; align-items: center; background-color: #1E1E1E;">

    <header>
        <?php
        include('../componentes/pgCabecalhoPaginas.php');
        
        ?>
    </header>
    <div class="container">
        <div class="containerLivroCapa">
            <img class="imgLivroCapa" src="<?php echo $livro_capa; ?>">
            <div>
                <div class="containerInformacoesLivro">
                    <div class="containerAlinhamentoLadoEsquerdo">
                        <div>
                            <h4>Avaliação do Livro</h4>
                            <div style="display: flex; align-items: center; height: 3.25rem;">
                                <img src="../img/star.png" class="imgAvaliacao">
                                <div style="margin-left: 1.5rem; height: 3.25rem;">
                                    <div style="display: flex; height: 1.75rem;">
                                        <p>4,9</p>
                                        <p style="opacity: 20%;">/5</p>
                                    </div>
                                    <p style="height: 1.75rem;">100 mil</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4>Autor</h4>
                            <p><?php echo $livro_autor; ?></p>
                        </div>
                        <div>
                            <h4>Ano de Publicação</h4>
                            <p><?php echo $livro_ano; ?></p>
                        </div>
                    </div>

                    <div class="containerAlinhamentoLadoDireito">
                        <div>
                            <h4>Sua Avaliação</h4>
                            <div style="display: flex; margin-top: 1.37rem;">
                                <img src="../img/starAvaliacao.png" class="imgAvaliacao">
                                <div style="margin-left: 1.5rem;">
                                    <p style="color: #0A58CA; margin-left: 1.18rem;">Avaliar</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4>Gênero da Obra</h4>
                            <p><?php echo $livro_genero; ?></p>
                        </div>
                        <div>
                            <h4>Editora</h4>
                            <p><?php echo $livro_editora; ?></p>
                        </div>
                    </div>
                </div>

                <div class="containerDescricao">
                    <h4>Descrição</h4>
                    <p><?php echo $livro_descricao; ?>
                    </p>
                    <button type="button" class="btn btn-warning" style="width: 16.31rem; height: 3.28rem;"><img
                            src="../img/coracao.png"
                            style="width: 24px; height: 24px; margin-right: 0.5rem;">Adicionar aos
                        favoritos</button>
                    <button type="button" class="btn btn-info" style="width: 16.31rem; height: 3.28rem; margin-left: 89px"><img
                            src="../img/img.visto.png"
                            style="width: 24px; height: 24px; margin-right: 0.5rem;">Marcar livro como já lido</button>
                </div>
            </div>
        </div>

        <div class="containerLivrosRecomendados">
            <h4>Livros Recomendados</h4>
            <div class="containerLivro">
                <?php
                include('../componentes/componentesPaginas_tcc/livrosRecomendados.php');
                ?>
            </div>
        </div>

        <hr>

    </div>
</body>

</html>