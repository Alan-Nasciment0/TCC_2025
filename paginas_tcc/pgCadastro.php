<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../css_js/css/styleCadastro.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de cadastro-TCC</title>
</head>

<body>
    <div class="containerPrincipal">
        <div class="containerLogin">
            <h2 class="titulo">Fazer cadastro</h2>
            <div class="containerLogo">
                <a class="logo" href=""><img src="../img/img.teste.webp"></a>
            </div>
            <form action="../salvarUsuario.php" method="post">
                <input type="hidden" name="acao" value="cadastrar">
                <div class="containerPreencher0">
                    <label>Nome do usuário</label>
                    <div class="campoPreencher">
                        <input class="placeHolder" type="text" id="nome" name="nome" placeholder="Digite seu nome"
                            class="text-body-secondary">
                    </div>
                </div>

                <div class="containerPreencher1">
                    <label>Email</label>
                    <div class="campoPreencher">
                        <input class="placeHolder" type="text" id="email" name="email" placeholder="Digite seu email"
                            class="text-body-secondary">
                    </div>
                </div>

                <div class="containerPreencher1">
                    <label>Senha</label>
                    <div class="campoPreencher">
                        <a class="imgMiniatura" href="" style="width: 24px; height: 24px; position: absolute;"><img
                                src="../img/img.senha.png"></a>
                        <input class="placeHolder" type="password" id="senha" name="senha"
                            placeholder="Digite sua senha." class="text-body-secondary">
                    </div>
                </div>

                <div class="containerPreencher1">
                    <label>Confirma a senha</label>
                    <div class="campoPreencher">
                        <a class="imgMiniatura" href="" style="width: 24px; height: 24px; position: absolute;"><img
                                src="../img/img.senha.png"></a>
                        <input class="placeHolder" type="text" id="confirmaSenha" name="confirmaSenha"
                            placeholder="Digite novamente a senha" class="text-body-secondary">
                    </div>
                </div>

                <div class="botoes">
                    <input type="submit" name="Criar conta" value="Criar conta">
                </div>
            </form>
        </div>
    </div>
</body>

</html>