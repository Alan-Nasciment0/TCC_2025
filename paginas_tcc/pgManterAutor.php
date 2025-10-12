<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manter Livro</title>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleManterAutor.css">
</head>

<body>
    <div class="container">
        <h1>Manter Autor</h1>
        <div class="containerManter">
            <search class="containerPesquisa">
                <form>
                    <img src="../img/pesquisarPreto.png" class="imgPesquisa">
                    <input name="pesquisa" placeholder="Pesquise um autor">
                </form>
            </search>

            <div class="containerInformacoesLivro">
                <div style="display: flex; gap: 8.31rem; margin-top: 6.56rem;">
                    <div class="adicionarCapaLivro">
                        <label for="file-upload" class="custom-file-label"><img src="../img/nuvem.png"></label>
                        <label for="file-upload" class="custom-file-label">Adicionar Foto do Autor</label>
                        <input type="file" id="file-upload" style="display: none;">
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
                            <label>Gênero do livro</label>
                            <div class="campoPreencher">
                                <input class="placeHolder" type="text" id="genero" name="genero"
                                    placeholder="Digite o gênero" class="text-body-secondary">
                            </div>
                        </div>

                        <div class="containerCampoPreencher">
                            <label>Ano de publicação</label>
                            <div class="campoPreencherData">
                                <input class="placeHolder" type="date" id="anoPubli" name="anoPubli"
                                    class="text-body-secondary">
                            </div>
                        </div>

                    </div>
                </div>

                <div style="margin-top: 1.87rem;">
                    <label>Descrição do Autor</label>
                    <div class="campoDescricao">
                        <input class="placeHolder" type="text" id="descricao" name="descricao"
                            placeholder="Digite a descrição do autor" size="400" style="width: 59.68rem;">
                    </div>
                    <div class="containerBotoes">
                        <button type="button" class="btn btn-dark" style="display: none;">Deasativar Autor</button>
                        <button type="button" class="btn btn-dark">Adicionar Autor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>