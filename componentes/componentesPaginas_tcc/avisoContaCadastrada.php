<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <link rel="stylesheet" href="../css_js/css/styleAvisoInfoSalvaAutor.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <div class="containerAvisoInfoSalvaAutor">
        <div class="containerAvisoInfoAutor">
            <img class="imgAvisoConfirmAutor" src="../img/OK_Aviso.png">
            <h2 class="tituloAvisoInfoAutor">Conta criada com sucesso.</h2>
            <div class="botaoOKAvisoInfoAutor">
                <input type="submit" name="fecharAviso" class="botaoTituloFazerLogin" value="Fazer Login">
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const botaoFechar = document.querySelector('input[name="fecharAviso"]');
            const modal = document.getElementById('modalAvisoContaCadastrada');

            botaoFechar.addEventListener("click", function () {
                window.location.href = "pgLogin.php"; 
                
            });
        });
    </script>
</body>

</html>