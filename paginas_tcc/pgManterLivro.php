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
    <link rel="stylesheet" href="../css_js/css/styleManterLivro.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
</head>

<body>
    <header>
        <?php
        include('../componentes/componentesPaginas_tcc/pgCabecalhoPaginas.php');
        
        ?>
    </header>
    <div class="containerManterLivro">
        <div class="containerTitulo">
            <h1 class="titulo">Manter Livro</h1>
        </div>
        <div class="containerManter">
            <search class="containerPesquisa" style="position: relative;">
                <img src="../img/pesquisarPreto.png" class="imgPesquisa">
                <input name="pesquisaLivro" id="pesquisaLivro" placeholder="Pesquise um livro" autocomplete="off">
                <div id="resultadoPesquisa" class="resultado-lista-livro"></div>
            </search>
            <script>
                const inputPesquisa = document.getElementById('pesquisaLivro');
                const resultado = document.getElementById('resultadoPesquisa');

                function carregarLivro(id) {
                    fetch(`../buscaLivros/carregarInfoLivroManterLivro.php?id=${id}`)
                        .then(response => response.json())
                        .then(data => {

                            document.getElementById('livro_cod').value = data.livro_cod;
                            document.getElementById('pesquisaAutor').value = data.autor_nome;
                            document.getElementById('livro_titulo').value = data.livro_titulo;
                            document.getElementById('livro_genero').value = data.genero_nome;
                            document.getElementById('pesquisaCategoria').value = data.categoria_nome;
                            document.getElementById('livro_ano').value = data.livro_ano;
                            document.getElementById('livro_editora').value = data.livro_editora;
                            document.getElementById('livro_descricao').value = data.livro_descricao;
                            document.getElementById('livro_capa_link').value = data.livro_capa_link;

                            const imgCapaLivro = document.getElementById('imagemCapa');
                            if (data.livro_capa_link && data.livro_capa_link.trim() !== "") {
                                imgCapaLivro.src = data.livro_capa_link;
                            }

                            document.getElementById('btnDesativar').style.display = "block";
                            document.getElementById('btnAlterar').style.display = "block";
                        });
                }
                inputPesquisa.addEventListener('input', function () {
                    const termoPesquisa = this.value.trim();
                    if (termoPesquisa.length > 0) {
                        fetch(`../buscaLivros/buscaLivrosBarraPesquisa.php?pesquisaLivro=${encodeURIComponent(termoPesquisa)}`)
                            .then(response => response.text())
                            .then(html => {
                                resultado.innerHTML = html;
                                resultado.style.display = 'block';
                            });
                    } else {
                        resultado.innerHTML = '';
                        resultado.style.display = 'none';
                    }
                });

                // Delegação de clique para itens carregados dinamicamente
                resultado.addEventListener('click', function (e) {
                    const item = e.target.closest('.resultado-item');
                    if (item) {
                        const id = item.getAttribute('data-id');
                        carregarLivro(id);

                        resultado.innerHTML = '';
                        resultado.style.display = 'none';
                        inputPesquisa.value = '';
                    }
                });
            </script>
            <form>
                <div class="containerInformacoesLivro">
                    <div style="display: flex; gap: 8.31rem; margin-top: 6.56rem;">
                        <input type="hidden" name="livro_cod" id="livro_cod"></input>
                        <div class="adicionarCapaLivro">
                            <img id="imagemCapa" alt="Capa do Livro" src="">
                            <label class="custom-file-label"><img src="../img/nuvem.png"></label>
                            <label class="custom-file-label">Adicionar capa do livro</label>
                            <input type="text" id="livro_capa_link" placeholder="Digite o link da capa do livro"
                                class="text-body-secondary" name="livro_capa_link">
                        </div>
                        <div class="informacoesLivro">
                            <div class="containerCampoPreencher">
                                <label>Nome do Livro</label>
                                <div class="campoPreencher">
                                    <input class="placeHolder" type="text" id="livro_titulo" name="livro_titulo"
                                        placeholder="Digite o nome do livro" class="text-body-secondary">
                                </div>
                            </div>

                            <div class="containerCampoPreencher">
                                <label>Autor do Livro</label>
                                <div class="campoPreencher" style="position: relative;">
                                    <input class="placeHolder" type="text" id="pesquisaAutor" name="autor_nome"
                                        placeholder="Digite o Autor" class="text-body-secondary">
                                    <input type="hidden" id="autor_cod" name="autor_cod">
                                    <div id="resultadoPesquisaAutor" class="resultado-lista"></div>
                                </div>
                                <script>
                                    const inputAutorNome = document.getElementById('pesquisaAutor');
                                    const resultadoAutor = document.getElementById('resultadoPesquisaAutor');

                                    function carregarAutor(id) {
                                        fetch(`../buscaAutor/carregarInfoAutorManterAutor.php?id=${id}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                // Preenche o formulário com os dados do autor
                                                document.getElementById('autor_cod').value = data.autor_cod;
                                                document.getElementById('pesquisaAutor').value = data.autor_nome;
                                            });
                                    }

                                    inputAutorNome.addEventListener('input', function () {
                                        const termoPesquisaAutor = this.value.trim();
                                        if (termoPesquisaAutor.length > 0) {
                                            fetch(`../buscaAutor/buscaAutorBarraPesquisa.php?pesquisaAutor=${encodeURIComponent(termoPesquisaAutor)}`)
                                                .then(response => response.text())
                                                .then(html => {
                                                    resultadoAutor.innerHTML = html;
                                                    resultadoAutor.style.display = 'block';
                                                });
                                        } else {
                                            resultadoAutor.innerHTML = '';
                                            resultadoAutor.style.display = 'none';
                                        }
                                    });

                                    // Delegação de clique para itens carregados dinamicamente
                                    resultadoAutor.addEventListener('click', function (e) {
                                        const item = e.target.closest('.resultado-item');
                                        if (item) {
                                            const idAutor = item.getAttribute('data-id');
                                            carregarAutor(idAutor);

                                            resultadoAutor.innerHTML = '';
                                            resultadoAutor.style.display = 'none';
                                        }
                                    });

                                </script>
                            </div>

                            <div class="containerGeneroCategoria">
                                <div class="containerCampoPreencher2">
                                    <label>Categoria do livro</label>
                                    <div class="campoPreencher2" style="position: relative;">
                                        <input class="placeHolder" type="text" id="pesquisaCategoria"
                                            name="livro_categoria" placeholder="Digite a categoria"
                                            class="text-body-secondary">
                                        <input type="hidden" id="categoria_cod" name="categoria_cod">
                                        <div id="resultadoPesquisaCategoria" class="resultado-lista-categoria"></div>
                                    </div>
                                    <script>
                                        const inputCategoria = document.getElementById('pesquisaCategoria');
                                        const resultadoCategoria = document.getElementById('resultadoPesquisaCategoria');

                                        function carregarCategoria(id) {
                                            fetch(`../buscaCategoria/carregarInfoCategoria.php?id=${id}`)
                                                .then(response => response.json())
                                                .then(data => {

                                                    document.getElementById('categoria_cod').value = data.categoria_cod;
                                                    document.getElementById('pesquisaCategoria').value = data.categoria_nome;
                                                });
                                        }

                                        inputCategoria.addEventListener('focus', function () {
                                            fetch('../buscaCategoria/buscaCategoriaBarraPesquisa.php')
                                                .then(response => response.text())
                                                .then(html => {
                                                    resultadoCategoria.innerHTML = html;
                                                    resultadoCategoria.style.display = 'block';
                                                });
                                        });


                                        inputCategoria.addEventListener('input', function () {
                                            const termoPesquisaCategoria = this.value.trim();
                                            if (termoPesquisaCategoria.length > 0) {
                                                fetch(`../buscaCategoria/buscaCategoriaBarraPesquisa.php?pesquisaCategoria=${encodeURIComponent(termoPesquisaCategoria)}`)
                                                    .then(response => response.text())
                                                    .then(html => {
                                                        resultadoCategoria.innerHTML = html;
                                                        resultadoCategoria.style.display = 'block';
                                                    });
                                            } else {

                                                fetch('../buscaCategoria/buscaCategoriaBarraPesquisa.php')
                                                    .then(response => response.text())
                                                    .then(html => {
                                                        resultadoCategoria.innerHTML = html;
                                                        resultadoCategoria.style.display = 'block';
                                                    });
                                            }
                                        });

                                        // Selecionar categoria
                                        resultadoCategoria.addEventListener('click', function (e) {
                                            const item = e.target.closest('.resultado-item');
                                            if (item) {
                                                const idCategoria = item.getAttribute('data-id');
                                                carregarCategoria(idCategoria);

                                                resultadoCategoria.innerHTML = '';
                                                resultadoCategoria.style.display = 'none';
                                            }
                                        });

                                    </script>
                                </div>
                                <div class="containerCampoPreencher2">
                                    <label>Gênero do livro</label>
                                    <div class="campoPreencher2" style="position: relative;">
                                        <input class="placeHolder" type="text" id="pesquisaGenero" name="livro_genero"
                                            placeholder="Digite o gênero" class="text-body-secondary">
                                        <input type="hidden" id="genero_cod" name="genero_cod">
                                        <div id="resultadoPesquisaGenero" class="resultado-lista-genero"></div>
                                    </div>
                                    <script>
                                        const inputGenero = document.getElementById('pesquisaCategoria');
                                        const resultadoGenero = document.getElementById('resultadoPesquisaGenero');

                                        function carregarGenero(id) {
                                            fetch(`../buscaCategoria/carregarInfoCategoria.php?id=${id}`)
                                                .then(response => response.json())
                                                .then(data => {

                                                    document.getElementById('genero_cod').value = data.genero_cod;
                                                    document.getElementById('pesquisaGenero').value = data.genero_nome;
                                                });
                                        }

                                        inputGenero.addEventListener('focus', function () {
                                            fetch('../buscaCategoria/buscaCategoriaBarraPesquisa.php')
                                                .then(response => response.text())
                                                .then(html => {
                                                    resultadoCategoria.innerHTML = html;
                                                    resultadoCategoria.style.display = 'block';
                                                });
                                        });


                                        inputCategoria.addEventListener('input', function () {
                                            const termoPesquisaCategoria = this.value.trim();
                                            if (termoPesquisaCategoria.length > 0) {
                                                fetch(`../buscaCategoria/buscaCategoriaBarraPesquisa.php?pesquisaCategoria=${encodeURIComponent(termoPesquisaCategoria)}`)
                                                    .then(response => response.text())
                                                    .then(html => {
                                                        resultadoCategoria.innerHTML = html;
                                                        resultadoCategoria.style.display = 'block';
                                                    });
                                            } else {

                                                fetch('../buscaCategoria/buscaCategoriaBarraPesquisa.php')
                                                    .then(response => response.text())
                                                    .then(html => {
                                                        resultadoCategoria.innerHTML = html;
                                                        resultadoCategoria.style.display = 'block';
                                                    });
                                            }
                                        });

                                        // Selecionar categoria
                                        resultadoCategoria.addEventListener('click', function (e) {
                                            const item = e.target.closest('.resultado-item');
                                            if (item) {
                                                const idCategoria = item.getAttribute('data-id');
                                                carregarCategoria(idCategoria);

                                                resultadoCategoria.innerHTML = '';
                                                resultadoCategoria.style.display = 'none';
                                            }
                                        });

                                    </script>
                                </div>
                            </div>

                            <div class="containerCampoPreencher">
                                <label>Ano de publicação</label>
                                <div class="campoPreencherData">
                                    <input class="placeHolder" type="date" id="livro_ano" name="livro_ano"
                                        class="text-body-secondary">
                                </div>
                            </div>

                            <div class="containerCampoPreencher">
                                <label>Editora do livro</label>
                                <div class="campoPreencher">
                                    <input class="placeHolder" type="text" id="livro_editora" name="livro_editora"
                                        placeholder="Digite a editora" class="text-body-secondary">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 1.87rem;">
                        <label>Descrição do Livro</label>
                        <div class="campoDescricao">
                            <textarea class="form-control" placeholder="Digite uma breve biografia do Livro."
                                id="livro_descricao" name="livro_descricao" style="height: 11.46rem;"></textarea>
                        </div>
                        <div class="containerBotoes">
                            <button type="submit" class="btn btn-dark" id="btnDesativar" name="btnDesativar"
                                style="display: none;">Desativar Livro</button>
                            <button type="submit" class="btn btn-dark" id="btnAlterar" name="btnAlterar"
                                style="display: none;">Alterar Livro</button>
                            <button type="submit" class="btn btn-dark" name="adicionarLivro">Adicionar Livro</button>
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