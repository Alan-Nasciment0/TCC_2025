<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleListaBani.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página lista de banidos</title>
</head>

<body>
    <div class="containerPrincipal">
        <div class="containerTitulo">
            <h2 class="titulo">Lista de Banido</h2>
        </div>
        <div class="containerListaBanidos">
            <div class="containerPesquisa">
                <img src="../img/pesquisarPreto.png" class="imgPesquisa" alt="Pesquisar">
                <input class="placeHolder1" type="text" name="pesquisaUsuario" id="pesquisaUsuario"
                    placeholder="Pesquise o nome do usuário">
            </div>
            <div class="containerBarra">
                <h2 class="usu">Usuário</h2>
                <h2 class="exp">Expira</h2>
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
</body>

</html>