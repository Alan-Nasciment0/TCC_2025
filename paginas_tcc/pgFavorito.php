<?php
session_start();
include('../conexao_bd_sql/conexao_bd_mysql.php'); // garante acesso ao PDO

$usuario_cod = $_SESSION['usuario_cod'] ?? null;

if (!$usuario_cod) {
    header('Location:pglogin.php');
    exit;
}

// Busca todos os livros favoritos do usuário
$sql = "
    SELECT L.livro_cod, L.livro_titulo, L.livro_capa_link, L.livro_editora, L.livro_ano, L.livro_descricao
    FROM Favoritos F
    INNER JOIN Livros L ON L.livro_cod = F.livro_cod
    WHERE F.usuario_cod = :usuario_cod
    ORDER BY F.favoritos_cod DESC
";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_cod', $usuario_cod, PDO::PARAM_INT);
$stmt->execute();
$favoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
</head>

<body style="background-color: #1E1E1E; color: white;">
    <header>
        <?php include('../componentes/pgCabecalhoPaginas.php'); ?>
    </header>

    <div class="containerPrincipal">
        <div class="containerFavorito">
            <h2 class="titulo">Meus Favoritos</h2>

            <div class="containerPesquisa">
                <img src="../img/pesquisarBranco.png" class="imgPesquisa" alt="Pesquisar">
                <input name="pesquisa" placeholder="Pesquisar livro"
                    style="width: 200px; height: 26px; margin-top: 73px;">
            </div>

            <div class="containerFiltro">
                <div class="dropdown">
                    <img src="../img/filtro.png" class="imgFiltro" alt="Filtro">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filtro
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Mais antigos</a></li>
                        <li><a class="dropdown-item" href="#">Mais novos</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <hr style="border-color: white;">

        <div class="container mt-4">
            <div class="row g-4 justify-content-center">
                <?php if (count($favoritos) > 0): ?>
                    <?php foreach ($favoritos as $livro): ?>
                        <div class="col-md-3">
                            <div class="card text-center" style="background-color: #2C2C2C; border: none; color: white;">
                                <img src="<?php echo $livro['livro_capa_link']; ?>" class="card-img-top" alt="Capa do livro">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $livro['livro_titulo']; ?></h5>
                                    <p class="card-text" style="font-size: 0.9rem; opacity: 0.8;">
                                        <?php echo $livro['livro_editora']; ?> (<?php echo $livro['livro_ano']; ?>)
                                    </p>
                                    <form action="../paginas_tcc/pgLivro.php" method="post">
                                        <input type="hidden" name="cod_livro_selecionado" value="<?php echo $livro['livro_cod']; ?>">
                                        <input type="hidden" name="livro_titulo_selecionado" value="<?php echo $livro['livro_titulo']; ?>">
                                        <input type="hidden" name="livro_capa_selecionado" value="<?php echo $livro['livro_capa_link']; ?>">
                                        <input type="hidden" name="livro_editora_selecionado" value="<?php echo $livro['livro_editora']; ?>">
                                        <input type="hidden" name="livro_ano_selecionado" value="<?php echo $livro['livro_ano']; ?>">
                                        <input type="hidden" name="livro_descricao_selecionado" value="<?php echo $livro['livro_descricao']; ?>">
                                        <button class="btn btn-primary mt-2">Ver livro</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align:center; opacity:0.7;">Nenhum livro foi adicionado aos favoritos ainda.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
