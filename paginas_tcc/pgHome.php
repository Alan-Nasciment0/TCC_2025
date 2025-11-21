<?php
session_start();

include('../BuscaLivros/buscaLivros.php');
include('../buscaAutor/buscaAutor.php');


$usuario_cod = $_SESSION['usuario_cod'] ?? null;


if (!$usuario_cod) {
    header('Location:pglogin.php');
    exit;
}

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
    <?php
    if (isset($_SESSION['perfilAtualizado'])){?>
    <div id="modalAvisoInfoAlteradoUsuario" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoAlterada">
            <?php include('../componentes/componentesPaginas_tcc/avisoInfoAlteradaUsuario.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoInfoAlteradoUsuario');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['perfilAtualizado']); ?>
    <?php
    }?>

    <header>

        <?php
        include('../componentes/componentesPaginas_tcc/pgCabecalhoPaginas.php');
        
        ?>

        <?php 
            $usuarioCod = $_SESSION['usuario_cod'];

            $sql = "SELECT COUNT(*) AS total FROM categoria_preferida_usuario WHERE usuario_cod = :usuario_cod";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario_cod', $usuarioCod, PDO::PARAM_INT);
            $stmt->execute();
            $resultadoCategoria = $stmt->fetch(PDO::FETCH_ASSOC); 

            $sql = "SELECT COUNT(*) AS total FROM genero_preferido_usuario WHERE usuario_cod = :usuario_cod";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario_cod', $usuarioCod, PDO::PARAM_INT);
            $stmt->execute();
            $resultadoGenero = $stmt->fetch(PDO::FETCH_ASSOC); 
            
        if ($resultadoCategoria['total'] == 0){?>
        <div id="modalCategoria" class="modal-overlay">
            <div class="modal-content">
                <?php include(__DIR__ . '/pgCategoria.php'); ?>
            </div>
        </div>
        <script>
            // Fechar o modal ao clicar fora dele
            document.addEventListener('click', function (event) {
                const modal = document.getElementById('modalCategoria');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        </script>
        <?php
        }elseif ($resultadoGenero['total'] == 0){?>
        <div id="modalGenero" class="modal-overlay">
            <div class="modal-content">
                <?php include(__DIR__ . '/pgGenero.php'); ?>
            </div>
        </div>
        <script>
            // Fechar o modal ao clicar fora dele
            document.addEventListener('click', function (event) {
                const modal = document.getElementById('modalGenero');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        </script>

        <?php } ?>

    </header>
    <?php
    if($_SESSION['nivel_acesso'] == 3) {
        $sql = "SELECT * FROM noticias ORDER BY noticia_cod DESC";
        $stmt = $pdo->query($sql);
        $banners_ativos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
    <div class="containerAddBanner">
        <button id="btnManterBanner" class="btn btn-dark">Manter Banner</button>
    </div>


    <div id="modalManterBanner" class="modalBanner" style="display:none;">
        <div class="modal-content">
            <span id="fecharModal"
                style="position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 20px;">&times;</span>
            <h3>Manter Banner</h3>
            <div class="containerBanners">
                <?php foreach ($banners_ativos as $banner): ?>
                <div class="containerTituloBanner">
                    <p>
                        <?= htmlspecialchars($banner['titulo']) ?>
                    </p>

                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $banner['noticia_cod'] ?>">

                        <?php if ($banner['status'] == 1): ?>
                        <button type="submit" name="acao" value="desativar" class="btn btn-danger">
                            Desativar
                        </button>
                        <?php else: ?>
                        <button type="submit" name="acao" value="ativar" class="btn btn-success">
                            Ativar
                        </button>
                        <?php endif; ?>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>

            <h4>Adicionar Novo Banner</h4>

            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="novo_banner">

                <label>Título:</label>
                <input type="text" name="titulo" class="form-control" required>

                <label>Link:</label>
                <input type="text" name="link" class="form-control" required>

                <label>Imagem do Banner:</label>
                <input type="file" name="banner_imagem" class="form-control" accept="image/*" required>

                <br>
                <button type="submit" class="btn btn-primary">Adicionar Banner</button>
            </form>

        </div>
    </div>

    <script>
        const btnManterBanner = document.getElementById('btnManterBanner');
        const modalManterBanner = document.getElementById('modalManterBanner');
        const fecharModal = document.getElementById('fecharModal');

        btnManterBanner.addEventListener('click', () => {
            modalManterBanner.style.display = 'flex';
        });

        fecharModal.addEventListener('click', () => {
            modalManterBanner.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modalManterBanner) {
                modalManterBanner.style.display = 'none';
            }
        });
    </script>
    <?php
    } ?>
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
             include('../componentes/componentesPaginas_tcc/livrosRecomendados.php');
            ?>
        </div>
    </div>

    <div class="containerLivrosPopulares">
        <h4>Livros Populares</h4>
        <div class="containerLivroPopular">
            <?php
             include('../componentes/componentesPaginas_tcc/livrosPopulares.php');
            ?>
        </div>
    </div>

    <div class="containerAutores" style="margin-top: 80px;">
        <h4>Autores</h4>
        <div class="containerAutor">
            <?php
             include('../componentes/componentesPaginas_tcc/buscaAutor.php');
            ?>
        </div>

    </div>

    <div class="containerLivrosLancamentos">
        <h4>Lançamentos</h4>
        <div class="containerLivroLancamento">
            <?php
             include('../componentes/componentesPaginas_tcc/livrosLancamentos.php');
            ?>
        </div>
    </div>

    <div class="containerLivrosFavoritos">
        <h4>Favoritos</h4>
        <div class="containerLivroFavorito">
            <?php
             include('../componentes/componentesPaginas_tcc/livrosFavoritos.php');
            ?>
        </div>
    </div>

    <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
    ?>
    <script>
        document.querySelectorAll('.marcador').forEach(btn => {
            btn.addEventListener('click', function () {
                const livroCod = this.getAttribute('data-livro-cod');
                const img = this.querySelector('img');

                fetch('../acoes/adicionarLivrosFavoritos.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'livro_cod=' + encodeURIComponent(livroCod)
                })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);

                        if (data.includes("✅")) {
                            img.src = '../img/bookmark_preenchido.png';
                        } else if (data.includes("❎")) {
                            img.src = '../img/salvar_livro.png';
                        }
                    })
                    .catch(error => {
                        alert("Erro ao adicionar livro aos favoritos.");
                        console.error(error);
                    });
            });
        });
    </script>

</body>

</html>