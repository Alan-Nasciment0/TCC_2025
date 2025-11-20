<?php
session_start();


$usuario_cod = $_SESSION['usuario_cod'] ?? null;


if (!$usuario_cod) {
    header('Location:pglogin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleAdicionarMod.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de adicionar moderador</title>
</head>

<body>
    <header>
        <?php
        include('../componentes/componentesPaginas_tcc/pgCabecalhoPaginas.php');
        
        ?>
    </header>
    <?php
    if (isset($_SESSION['moderadorAdicionado'])){?>
    <div id="modalAvisoModeradorAdicionado" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoModeradorAdicionado.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoModeradorAdicionado');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['moderadorAdicionado']); ?>
    <?php
    }else if (isset($_SESSION['moderadorRemovido'])){?>
    <div id="modalAvisoModeradorRemovido" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoModeradorRemovido.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoModeradorRemovido');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['moderadorRemovido']); ?>
    <?php
    }?>
    
    
    <div id="modal-overlay-usuarioModerador" class="modal-overlay-usuarioModerador">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoUsuarioModerador.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modal-overlay-usuarioModerador');
            const modal2 = document.getElementById('containerAvisoInfoSalvaAutor');
            if (event.target === modal) {
                modal.style.display = 'none';   
                modal2.style.display = 'none';                 

            }
        });
    </script>
    
    <div class="containerPrincipal">
        <div class="containerTitulo">
            <h2 class="titulo">Adicionar Moderador</h2>
        </div>
        <div class="containerAdicionarMode">
            <div class="containerPesquisa">
                <img src="../img/pesquisarPreto.png" class="imgPesquisa" alt="Pesquisar">
                <input class="placeHolder1" type="text" name="pesquisaUsuario" id="pesquisaUsuario"
                    placeholder="Pesquise o nome do usuário">
                <div id="resultadoPesquisaUsuario" class="resultado-lista"></div>
            </div>
            <script>
                const inputNomeUsuario = document.getElementById('pesquisaUsuario');
                const resultadoUsuario = document.getElementById('resultadoPesquisaUsuario');

                function carregarUsuario(id) {
                    fetch(`../buscaUsuario/carregarInfoUsuario.php?id=${id}`)
                        .then(response => response.json())
                        .then(data => {

                            document.getElementById('usuario_cod_pesquisado').value = data.usuario_cod_pesquisado;
                            document.getElementById('nome_usuario_pesquisado').value = data.nome_usuario_pesquisado;
                            document.getElementById('email_usuario_pesquisado').value = data.email_usuario_pesquisado;
                            document.getElementById('foto_usuario_pesquisado').value = data.foto_usuario_pesquisado;

                            const imgFotoUsuario = document.getElementById('foto_usuario_pesquisado');
                            if (data.foto_usuario_pesquisado && data.foto_usuario_pesquisado.trim() !== "") {
                                imgFotoUsuario.src = data.foto_usuario_pesquisado;
                            }

                            const btnAdd = document.getElementById('btnAdicionar');
                            const btnRemove = document.getElementById('btnRemover');


                            if (data.nivel_acesso_pesquisado == 2) {
                                btnAdd.style.display = "none";
                                btnRemove.style.display = "block";
                                btnAdm.style.display = "none";
                            } else if (data.nivel_acesso_pesquisado == 3) {
                                btnAdd.style.display = "none";
                                btnRemove.style.display = "none";
                                
                                const modal = document.getElementById("modal-overlay-usuarioModerador");
                                const modal2 = document.getElementById('containerAvisoInfoSalvaAutor');
                                modal.style.display = "flex";
                                modal2.style.display = "flex";
                                
                            } else {
                                btnAdd.style.display = "block";
                                btnRemove.style.display = "none";
                            }
                        });
                }

                inputNomeUsuario.addEventListener('input', function () {
                    const termoPesquisaUsuario = this.value.trim();
                    if (termoPesquisaUsuario.length > 0) {
                        fetch(`../buscaUsuario/buscaUsuarioBarraPesquisa.php?pesquisaUsuario=${encodeURIComponent(termoPesquisaUsuario)}`)
                            .then(response => response.text())
                            .then(html => {
                                resultadoUsuario.innerHTML = html;
                                resultadoUsuario.style.display = 'block';
                            });
                    } else {
                        resultadoUsuario.innerHTML = '';
                        resultadoUsuario.style.display = 'none';
                    }
                });

                // Delegação de clique para itens carregados dinamicamente
                resultadoUsuario.addEventListener('click', function (e) {
                    const item = e.target.closest('.resultado-item-usuario');
                    if (item) {
                        const idUsuario = item.getAttribute('data-id');
                        carregarUsuario(idUsuario);

                        resultadoUsuario.innerHTML = '';
                        resultadoUsuario.style.display = 'none';
                        inputNomeUsuario.value = '';
                    }
                });
            </script>

            <form action="../acoes/adicionarModerador.php" method="post">
                <input type="hidden" name="usuario_cod_pesquisado" id="usuario_cod_pesquisado"></input>
                <div class="containerCampo">
                    <div class="containerFoto">
                        <img class="fotousuario" id="foto_usuario_pesquisado" src="../img/img.teste.webp">
                    </div>
                    <div class="containerPreencher1">
                        <label>Nome do usuário</label>
                        <div class="campoPreencher">
                            <input class="placeHolder" type="text" id="nome_usuario_pesquisado"
                                name="nome_usuario_pesquisado" placeholder="Digite o nome do usuario"
                                class="text-body-secondary">
                        </div>
                    </div>
                    <div class="containerPreencher1">
                        <label>E-mail do usuário</label>
                        <div class="campoPreencher">
                            <input class="placeHolder" type="text" id="email_usuario_pesquisado"
                                name="email_usuario_pesquisado" placeholder="Digite o email do usuario"
                                class="text-body-secondary">
                        </div>
                    </div>
                    <div class="containerLinha">
                    </div>
                    <div style="width: 213px; height: 126px; display: flex; justify-content: center; flex-direction: column; align-items: center;"
                        class="botoes">
                        <button type="submit" style="width: 101px; height: 50px; margin-bottom: 6px;" id="btnAdicionar"
                            name="adicionarModerador" class="btn btn-success">Adicionar</button>
                        <button type="submit" style="width: 101px; height: 50px; margin-bottom: 6px; display: none;"
                            id="btnRemover" name="removerModerador" class="btn btn-danger">Remover</button>
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