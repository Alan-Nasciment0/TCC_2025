<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../css_js/css/styleLogin.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de login-TCC</title>
</head>
<body>
    <div class="container">
        <div class="containerLogin">
            <div class="containerLogo">
                <a class="logo" href=""><img src="../img/img.teste.webp"></a>
            </div>
            <h2 class="titulo">Fazer login</h2>
            <form action="../salvarUsuario.php" method="post">
                <div class="containerPreencher0">
                    <label>Email</label>
                    <div class="campoPreencher"> 
                        <input class="placeHolder" type="text" id="email" name="email" placeholder="Digite seu email" class="text-body-secondary">
                    </div>
                </div>

                <div class="containerPreencher1">
                    <label>Senha</label>
                    <div class="campoPreencher">
                        <a class="imgMiniatura" href="" style="width: 24px; height: 24px; position: absolute;"><img src="../img/img.senha.png"></a>
                        <input class="placeHolder" type="password" id="senha" name="senha" placeholder="Digite sua senha." class="text-body-secondary">
                    </div>
                </div>

                <div class="esqueciaSenha">
                    <a class="link-opacity-100" href="#">Esqueci a senha</a>
                </div>

                <div class="botoes">
                    <input type="submit" name="login" value="Entrar">
                    <input type="submit" value="Criar conta" style="margin-left: 135px;">
                </div>
            </form>
        </div>
    </div>
</body>
</html>