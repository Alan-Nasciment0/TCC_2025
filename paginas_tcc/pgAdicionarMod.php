<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleAdicionarMod.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de adicionar moderador</title>
</head>

<body>
    <div class="containerPrincipal">
        <div class="containerTitulo">
            <h2 class="titulo">Adicionar Moderador</h2>
        </div>
        <div class="containerAdicionarMode">
            <div class="containerPesquisa">
                <img src="../img/pesquisarPreto.png" class="imgPesquisa" alt="Pesquisar">
                <input class="placeHolder1" name="pesquisa" placeholder="Pesquise o nome do usuário">
            </div>
            <div class="containerCampo">
                <div class="containerFoto">
                    <a class="fotousuario" href=""><img src="../img/img.teste.webp"></a>
                </div>
                <div class="containerPreencher1">
                    <label>Nome do usuário</label>
                    <div class="campoPreencher">
                        <input class="placeHolder" type="text" id="nome" name="nome"
                            placeholder="Digite o nome do usuario" class="text-body-secondary">
                    </div>
                </div>
                <div class="containerPreencher1">
                    <label>E-mail do usuário</label>
                    <div class="campoPreencher">
                        <input class="placeHolder" type="text" id="nome" name="nome"
                            placeholder="Digite o email do usuario" class="text-body-secondary">
                    </div>
                </div>
                <div class="containerLinha">
                </div>
                <div style="width: 213px; height: 126px; display: flex; justify-content: center; flex-direction: column; align-items: center;" class="botoes">
                    <button type="button" style="width: 101px; height: 50px; margin-bottom: 6px;" class="btn btn-success">Adicionar</button>
                    <button type="button" style="width: 101px; height: 50px; margin-top: 6px;" class="btn btn-danger">Remover</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>