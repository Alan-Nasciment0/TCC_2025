<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manter Livro</title>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/pgManterLivro.css">
</head>
<body>
    <div class="container">
        <h1>Manter Livro</h1>
        <div class="containerManter">
            <search class="containerPesquisa">
                <form>
                    <img src="../img/pesquisarPreto.png" class="imgPesquisa">
                    <input name="pesquisa" placeholder="Pesquise um livro">
                </form>
            </search>

            <div class="containerInformacoesLivro">
                <div style="display: flex; gap: 8.31rem; margin-top: 6.56rem;">
                    <div class="adicionarCapaLivro">
                        <label for="file-upload" class="custom-file-label"><img src="../img/nuvem.png"></label>
                        <label for="file-upload" class="custom-file-label">Adicionar Capa do Livro</label>
                        <input type="file" id="file-upload" style="display: none;">
                    </div>
                    <div class="informacoesLivro">
                        <div class="containerCampoPreencher">
                            <label>Nome do Livro</label>
                            <div class="campoPreencher"> 
                                <input class="placeHolder" type="text" id="nomeLivro" name="nomeLivro" placeholder="Digite o nome do livro" class="text-body-secondary">
                            </div>
                        </div>

                        <div class="containerCampoPreencher">
                            <label>Autor do Livro</label>
                            <div class="campoPreencher"> 
                                <input class="placeHolder" type="text" id="autor" name="autor" placeholder="Digite o Autor" class="text-body-secondary">
                            </div>
                        </div>

                        <div class="containerCampoPreencher">
                            <label>Gênero do livro</label>
                            <div class="campoPreencher"> 
                                <input class="placeHolder" type="text" id="genero" name="genero" placeholder="Digite o gênero" class="text-body-secondary">
                            </div>
                        </div>

                        <div class="containerCampoPreencher">
                            <label>Ano de publicação</label>
                            <div class="campoPreencher"> 
                                <input class="placeHolder" type="text" id="anoPubli" name="anoPubli" placeholder="Digite o ano" class="text-body-secondary">
                            </div>
                        </div>

                        <div class="containerCampoPreencher">
                            <label>Editora do livro</label>
                            <div class="campoPreencher"> 
                                <input class="placeHolder" type="text" id="editora" name="editora" placeholder="Digite a editora" class="text-body-secondary">
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 1.87rem;">
                    <label>Descrição</label>
                            <div class="campoDescricao"> 
                                <input class="placeHolder" type="text" id="descricao" name="descricao" placeholder="Digite a Descrição do livro" size="400" style="width: 59.68rem;">
                            </div>
                            <button type="button" class="btn btn-dark" style="float: right; margin-top: 1.87rem;">Adicionar Livro</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>