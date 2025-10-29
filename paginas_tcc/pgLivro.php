<?php

include('../BuscaLivros/buscaLivros.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Livro</title>
    <link rel="stylesheet" href="../css_js/css/styleLivro.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body
    style="width: 100%;height: auto; display: flex; flex-direction: column; align-items: center; background-color: #1E1E1E;">
    <div class="container">
        <div class="containerLivroCapa">
            <img class="imgLivroCapa" src="../img/livro.jpg">
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
                            <p>Machado de Assis</p>
                        </div>
                        <div>
                            <h4>Ano de Publicação</h4>
                            <p>1899</p>
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
                            <p>Ficção e Romance</p>
                        </div>
                        <div>
                            <h4>Editora</h4>
                            <p>Nemo</p>
                        </div>
                    </div>
                </div>

                <div class="containerDescricao">
                    <h4>Descrição</h4>
                    <p>Dom Casmurro é um romance de Machado de Assis, publicado em 1899. Narrado na primeira pessoa, o
                        enredo gira em torno de Bentinho eCapitu,dois amigos de infância que acabam casando. O livro
                        explora temas atemporais como a desconfiança, o ciúme e a traição.Traçandoum retrato moral da
                        época, a obra é considerada a maior de Machado de Assis, e uma das mais importantes da
                        literatura brasileira.
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