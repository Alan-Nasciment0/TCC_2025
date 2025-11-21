<?php
include('../BuscaLivros/buscaLivros.php');
include('../buscaAutor/buscaAutor.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $acao = $_POST['acao'];

    if ($acao == "desativar") {
        $stmt = $pdo->prepare("UPDATE Noticias SET status = 0 WHERE noticia_cod = ?");
        $stmt->execute([$id]);
    }

    if ($acao == "ativar") {
        $stmt = $pdo->prepare("UPDATE Noticias SET status = 1 WHERE noticia_cod = ?");
        $stmt->execute([$id]);
    }

    if ($acao == "novo_banner") {
        $titulo = $_POST['titulo'];
        $link = $_POST['link'];

        // Upload da imagem
        $ext = pathinfo($_FILES["banner_imagem"]["name"], PATHINFO_EXTENSION);
        $nomeArquivo = time() . "_" . uniqid() . "." . $ext;

        $destino = "../img/banners/" . $nomeArquivo;
        move_uploaded_file($_FILES["banner_imagem"]["tmp_name"], $destino);

        // Inserir no banco
        $stmt = $pdo->prepare(
            "INSERT INTO Noticias (titulo, banner_imagem, link ) VALUES (?, ?, ?)"
        );
        $stmt->execute([$titulo, $nomeArquivo, $link]);
    }

    // atualiza a página
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela home</title>

    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css_js/css/styleHome.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleContainerLivros.css">
    <link rel="stylesheet" href="../css_js/css/styleContainerAutores.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <?php

        include('../componentes/componentesIndex/pgCabecalhoIndex.php');        

?>
    </header>
    <div class="container">
        <div class="carousel-container">
            <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
                <div class="bannerGradiente">
                    <div class="carousel-inner">
                        <?php
                        include('../componentes/componentesPaginas_tcc/buscaBanner.php');
                        ?>  
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="containerLivrosRecomendados">
        <h4>Livros Recomendados</h4>
        <div class="containerLivroRecomendado">
            <?php
             include('../componentes/componentesIndex/livrosRecomendados.php');
            ?>
        </div>
    </div>

    <div class="containerLivrosPopulares">
        <h4>Livros Populares</h4>
        <div class="containerLivroPopular">
            <?php
             include('../componentes/componentesIndex/livrosPopulares.php');
            ?>
        </div>
    </div>

    <div class="containerAutores" style="margin-top: 80px;">
        <!--Autores em destaque-->
        <h4>Autores</h4>
        <div class="containerAutor">
            <?php
             include('../componentes/componentesIndex/buscaAutor.php');
            ?>
        </div>
    </div>

    <div class="containerLivrosLancamentos">
        <h4>Lançamentos</h4>
        <div class="containerLivroLancamento">
            <?php
             include('../componentes/componentesIndex/livrosLancamentos.php');
            ?>
        </div>
    </div>

    <div class="containerLivrosFavoritos">
        <h4>Sua lista</h4>
        <div class="containerAviso">
            <label style="color: white;">Quer salvar seus livros favorito?</label>
            <img src="../img/bookmark.png" class="imgFavorito" alt="Favorito">
            <label style="color: white;">Faça login para salvar seus livros</label>
            <div class="botaoFazerLogin">
                <button type="submit" name="Criar conta" class="btn btn-light" value="Fazer login">Fazer Login</button>
            </div>
        </div>

    </div>

    <hr style="width: 100%; border-color: white;">
    <footer>
        <form style="width: 270px; height: 220px;">
            <div class="containerAviso">
                <img src="../img/Quanto_mais_você_lê_mais_você_voa__2_-removebg-preview.png" class="imgLogo" alt="Logo">
                <label style="color: white;">Quanto mais você le, mais você voa</label>
                <label style="color: white;">2025 - TCC ETEC</label>
            </div>
        </form>
    </footer>

    <script>
    document.querySelectorAll('.marcador').forEach(btn => {
        btn.addEventListener('click', function () {
            alert("Você precisa estar logado para adicionar aos favoritos.");
            return;
        });
    });

    document.querySelectorAll('.btn-light').forEach(btn => {
        btn.addEventListener('click', function () {
             window.location.href = '../paginas_tcc/pgLogin.php';
        });
    });
</script>

</body>

</html>