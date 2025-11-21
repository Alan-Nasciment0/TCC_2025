<?php
session_start();
include('../conexao_bd_sql/conexao_bd_mysql.php'); // garante acesso ao PDO

$usuario_cod = $_SESSION['usuario_cod'] ?? null;

if (!$usuario_cod) {
    header('Location:pglogin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Favoritos</title>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleFavorito.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <link rel="stylesheet" href="../css_js/css/styleContainerLivros.css">
</head>

<body>
    <header>

        <?php
        include('../componentes/componentesPaginas_tcc/pgCabecalhoPaginas.php');
        
        ?>

    </header>

    <div class="containerPrincipal">
        <div class="containerFavoritos">
            <div class="containerTitulo">
                <h2 class="titulo">Favoritos</h2>
            </div>

        </div>
        <div class="containerLivrosFavoritos">
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