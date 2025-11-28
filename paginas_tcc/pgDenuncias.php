<?php
session_start();


$usuario_cod = $_SESSION['usuario_cod'] ?? null;


if (!$usuario_cod) {
    header('Location:pgLogin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleListaBani.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página lista de Denuncias</title>
</head>

<body>
    <header>
        <?php
        include('../componentes/componentesPaginas_tcc/pgCabecalhoPaginas.php');
        
        ?>
    </header>
    <div class="containerPrincipal">
        <div class="containerTitulo">
            <h2 class="titulo">Lista de Denuncias</h2>
        </div>
        <div class="containerListaBanidos">
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
            <div class="containerBarra">
                <h2 class="usu">Usuário</h2>
                <h2 class="exp">Comentário</h2>
                <h2 class="acoe">Motivo</h2>
                <h2 class="acoe">Ações</h2>
                
            
            </div>
            <form>
                <div data-bs-spy="scroll" data-bs-target="containerCampo" data-bs-smooth-scroll="true"
                    class="scrollspy-example-2" tabindex="0">
                    <div class="containerCampo">
                        <h5 class="nome_usu">@nome_usuario</h5>
                        <h5 class="tem_bam">tempo_bam</h5>
                        <img src="../img/acoes.png" class="imgAcoes" alt="Acoes">
                    </div>
                </div>
            </form>
        </div>
        <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
        ?>
</body>

</html>