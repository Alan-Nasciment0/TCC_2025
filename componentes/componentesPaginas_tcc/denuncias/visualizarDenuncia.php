<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../../css_js/css/styleDenunciaSelecionada.css">
    <link rel="stylesheet" href="../../../css_js/bootstrap/css/bootstrap.min.css">

</head>

<body>

    <div id="modalDenuncia" class="modalDenunciaBackground">
        <div class="containerDenunciaSelecionado">

            <!-- USUÁRIO -->
            <div class="containerInforUsuario">
                <div>
                    <img id="modalFotoUsuario" src="" class="imgUsuarioBan">
                </div>

                <div class="containerNomeUsuario">
                    <h6 id="modalNomeUsuario">@nome</h6>
                    <h6 id="modalQtdDenuncias">Denúncias: 0</h6>
                </div>
            </div>

            <!-- LIVRO + COMENTÁRIO -->
            <div class="containerInfoLivroComentario">
                <h6 id="modalNomeLivro">Nome do Livro</h6>
                <textarea disabled id="modalComentario"></textarea>
            </div>

            <!-- AÇÕES -->
            <div style="margin-top: 1.5rem;">
                <h6>Banir</h6>
                <div class="containerOpcoesBanimento">
                    <button class="botao1" data-duracao="3 Dias">3 Dias</button>
                    <button class="botao1" data-duracao="7 Dias">7 Dias</button>
                    <button class="botao1" data-duracao="14 Dias">14 Dias</button>
                    <button class="botao2" data-duracao="permanente">Permanente</button>
                </div>
            </div>

            <!-- FECHAR -->
            <div class="botaoFecharDenuncia">
                <button class="btn btn-danger" onclick="fecharModal()">Fechar</button>
            </div>

        </div>
    </div>
</body>

</html>