<?php
session_start();
include('../BuscaLivros/buscaLivros.php');

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
    <title>Manter Autor</title>
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
    <div id="modalAvisoInfoSalvaAutor" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoInfoSalvaAutor.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoInfoSalvaAutor');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['autorAdicionado']); ?>
    <?php
    }else if (isset($_SESSION['autorAlterado'])){?>
    <div id="modalAvisoInfoAlteradoAutor" class="modal-overlay-InfoAlterado">
        <div class="modal-content-InfoAlterado">
            <?php include('../componentes/componentesPaginas_tcc/avisoInfoAlteradaAutor.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoInfoAlteradoAutor');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['autorAlterado']); ?>
    <?php
    }else if (isset($_SESSION['autorDesativado'])){?>
    <div id="modalAvisoInfoDesativadoAutor" class="modal-overlay-InfoDesativado">
        <div class="modal-content-InfoDesativado">
            <?php include('../componentes/componentesPaginas_tcc/avisoInfoDesativadaAutor.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoInfoDesativadoAutor');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['autorDesativado']); ?>
    <?php
    }?>
    <div class="containerManterAutor">
        <div class="containerTitulo">
            <h1 class="titulo">Manter Autor</h1>
        </div>
        <div class="containerManter">
            <search class="containerPesquisa">
                <img src="../img/pesquisarPreto.png" class="imgPesquisa">
                <input name="pesquisaAutor" id="pesquisaAutor" placeholder="Pesquise um autor" autocomplete="off">
                <div id="resultadoPesquisa" class="resultado-lista"></div>
            </search>
            <script>
                const inputPesquisa = document.getElementById('pesquisaAutor');
                const resultado = document.getElementById('resultadoPesquisa');

                function carregarAutor(id) {
                    fetch(`../buscaAutor/carregarInfoAutorManterAutor.php?id=${id}`)
                        .then(response => response.json())
                        .then(data => {
                            // Preenche o formulário com os dados do autor
                            document.getElementById('autor_cod').value = data.autor_cod;
                            document.getElementById('nomeAutor').value = data.autor_nome;
                            document.getElementById('dataNascimentoAutor').value = data.autor_data_nascimento;
                            document.getElementById('dataFalecimentoAutor').value = data.autor_data_falecimento;
                            document.getElementById('movimentoLiterario').value = data.autor_movimento_literario;
                            document.getElementById('biografia').value = data.autor_biografia;
                            document.getElementById('fotoAutor').value = data.autor_link_foto;

                            const imgAutor = document.getElementById('imagemAutor');
                            if (data.autor_link_foto && data.autor_link_foto.trim() !== "") {
                                imgAutor.src = data.autor_link_foto;
                            }

                            document.getElementById('btnDesativar').style.display = "block";
                            document.getElementById('btnAlterar').style.display = "block";
                        });
                }

                inputPesquisa.addEventListener('input', function () {
                    const termoPesquisa = this.value.trim();
                    if (termoPesquisa.length > 0) {
                        fetch(`../buscaAutor/buscaAutorBarraPesquisa.php?pesquisaAutor=${encodeURIComponent(termoPesquisa)}`)
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
                    const item = e.target.closest('.resultado-item-autor');
                    if (item) {
                        const idAutor = item.getAttribute('data-id');
                        carregarAutor(idAutor);

                        resultado.innerHTML = '';                    
                        resultado.style.display = 'none';
                        inputPesquisa.value = '';
                    } 
                });

            </script>


            <form action="../acoes/adicionar_editar_desativar_Autor.php" method="post">
                <input type="hidden" name="autor_cod" id="autor_cod"></input>
                <div class="containerInformacoesLivro">
                    <div style="display: flex; gap: 8.31rem; margin-top: 6.56rem;">

                        <div class="adicionarCapaLivro">
                            <img id="imagemAutor" alt="Foto do Autor" src="">
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
                                    <input type="date" class="placeHolder" id="dataNascimentoAutor"
                                        name="dataNascimentoAutor" class="text-body-secondary">
                                </div>
                            </div>

                            <div class="containerCampoPreencher">
                                <label>Data de Falecimento</label>
                                <div class="campoPreencherData">
                                    <input type="date" class="placeHolder" id="dataFalecimentoAutor"
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
                            <textarea class="form-control" placeholder="Digite uma breve biografia do autor."
                                id="biografia" name="biografia" style="height: 11.46rem;"></textarea>
                        </div>
                        <div class="containerBotoes">
                            <button type="submit" class="btn btn-dark" id="btnDesativar" name="btnDesativar" style="display: none;">Deasativar Autor</button>
                            <button type="submit" class="btn btn-dark" id="btnAlterar" name="btnAlterar" style="display: none;">Alterar Autor</button>
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