<?php
session_start();
include('../BuscaLivros/buscaLivros.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manter Livro</title>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleManterAutor.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
</head>

<body>
    <header>
        <?php
        include('../componentes/componentesPaginas_tcc/pgCabecalhoPaginas.php');
        
        ?>
    </header>
    <?php
    if (isset($_SESSION['autorAdicionado'])){?>
    <div id="modalCategoria" class="modal-overlay">
        <div class="modal-content">
            <?php include('../componentes/componentesPaginas_tcc/avisoInfoSalvaAutor.php'); ?>
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
    <?php unset($_SESSION['autorAdicionado']); ?>
    <?php
    }?>
    <div class="containerManterAutor">
        <div class="containerTitulo">
            <h1 class="titulo">Manter Autor</h1>
        </div>
        <div class="containerManter">
            <search class="containerPesquisa">
                <form>
                    <img src="../img/pesquisarPreto.png" class="imgPesquisa">
                    <input name="pesquisa" placeholder="Pesquise um autor">
                </form>
            </search>

            <form action="../acoes/adicionar_editar_Autor.php" method="post">
                <div class="containerInformacoesLivro">
                    <div style="display: flex; gap: 8.31rem; margin-top: 6.56rem;">

                        <div class="adicionarCapaLivro">
                            <label class="custom-file-label"><img src="../img/nuvem.png"></label>
                            <label class="custom-file-label">Adicionar Foto do Autor</label>
                            <input type="text" id="fotoAutor" placeholder="Digite o link da foto do Autor"
                                class="text-body-secondary" name="fotoAutor">
                        </div>
                        <div class="informacoesLivro">
                            <div class="containerCampoPreencher">
                                <label>Nome do Autor</label>
                                <div class="campoPreencher">
                                    <input class="placeHolder" type="text" id="nomeAutor" name="nomeAutor"
                                        placeholder="Digite o nome do Autor" class="text-body-secondary">
                                </div>
                            </div>

                            <div class="containerCampoPreencher">
                                <label>Data de Nascimento</label>
                                <div class="campoPreencherData">
                                    <input type="date" class="placeHolder" type="text" id="dataNascimentoAutor"
                                        name="dataNascimentoAutor" class="text-body-secondary">
                                </div>
                            </div>

                            <div class="containerCampoPreencher">
                                <label>Data de Falecimento</label>
                                <div class="campoPreencherData">
                                    <input type="date" class="placeHolder" type="text" id="dataFalecimentoAutor"
                                        name="dataFalecimentoAutor" class="text-body-secondary">
                                </div>
                            </div>

                            <div class="containerCampoPreencher">
                                <label>Movimento Literário</label>
                                <div class="campoPreencher">
                                    <input class="placeHolder" type="text" id="movimentoLiterario"
                                        name="movimentoLiterario" placeholder="Digite o movimento literario do autor"
                                        class="text-body-secondary">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div style="margin-top: 1.87rem;">
                        <label>Biografia do Autor</label>
                        <div class="campoDescricao">
                            <textarea class="form-control" placeholder="Digite uma breve biografia do autor." id="biografia"
                                style="height: 11.46rem;"></textarea>
                        </div>
                        <div class="containerBotoes">
                            <button type="button" class="btn btn-dark" style="display: none;">Deasativar Autor</button>
                            <button type="submit" class="btn btn-dark" name="adicionarAutor">Adicionar Autor</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
    ?>
</body>

</html>