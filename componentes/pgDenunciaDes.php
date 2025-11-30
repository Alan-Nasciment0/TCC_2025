<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css_js/css/styleDenunciaDes.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página descrição da denuncia</title>
</head>

<body>
    <div class="containerDenunciaDescriPrincipal">
        <div class="containerDescrição">
            <h2 class="titulo">Denunciar comentario</h2>
            <h3 class="descrição">Forneça mais detalhes:</h3>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="descricaoDenuncia"
                    style="height: 144px; width: 350px"></textarea>
                <label for="floatingTextarea2" >Comente aqui</label>
            </div>
            <div class="botoes">
                <input type="submit" name="cancelar" value="Cancelar" onclick="toggleDisplay2()" style="color: black; background-color: white;">
                <input type="submit" name="salvarDenuncia" onclick="salvarDenuncia()" value="Enviar denuncia">
            </div>
        </div>
    </div>
</body>

</html>