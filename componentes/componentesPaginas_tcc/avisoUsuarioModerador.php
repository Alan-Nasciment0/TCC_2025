<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <link rel="stylesheet" href="../css_js/css/styleAvisoUsuarioModerador.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <div class="containerAvisoInfoSalvaAutor">
        <div class="containerAvisoInfoAutor">
            <img class="imgAvisoConfirmAutor" src="../img/alerta.png">
            <h2 class="tituloAvisoInfoAutor">Esse usuário ja é moderador.</h2>
            <div class="botaoOKAvisoInfoAutor">
                <input type="submit" name="fecharAviso" class="botaoTitulo" value="OK">
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const botaoFechar = document.querySelector('input[name="fecharAviso"]');
            
            const modal = document.getElementById('modal-overlay-usuarioModerador');
            const modal2 = document.getElementById('containerAvisoInfoSalvaAutor');

            botaoFechar.addEventListener("click", function () {
                modal.style.display = 'none';
                modal2.style.display = 'none';
                
            });
        });
    </script>
</body>

</html>