<?php

$usuario_cod = $_SESSION['usuario_cod'] ?? null;

if (!$usuario_cod) {
    header('Location:pglogin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../css_js/css/styleRecuperarSenhaConfirmacao.css">
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
            <h2 class="titulo">Esqueci a senha</h2>
            <form>
                <div class="containerPreencher0">
                    <label>Nova senha</label>
                    <div class="campoPreencher">
                        <a class="imgMiniatura" href="" style="width: 24px; height: 24px; position: absolute;"><img
                                src="../img/img.senha.png"></a>
                        <input class="placeHolder" type="text" id="email" name="email"
                            placeholder="Digite sua nova senha" class="text-body-secondary">
                    </div>
                </div>

                <div class="containerPreencher1">
                    <label>Confirmar a senha</label>
                    <div class="campoPreencher">
                        <a class="imgMiniatura" href="" style="width: 24px; height: 24px; position: absolute;"><img
                                src="../img/img.senha.png"></a>
                        <input class="placeHolder" type="password" id="senha" name="senha"
                            placeholder="Digite novamente a senha" class="text-body-secondary">
                    </div>
                </div>

                <div class="botoes">
                    <input type="submit" value="Confirmar alteração">
                </div>
            </form>
        </div>
    </div>
</body>

</html>