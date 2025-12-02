<?php
session_start();
include('../conexao_bd_sql/conexao_bd_mysql.php'); // garante acesso ao PDO

$usuario_cod = $_SESSION['usuario_cod'] ?? null;

if (!$usuario_cod) {
    header('Location:pglogin.php');
    exit;
}

$pesquisa = isset($_GET['pesquisaTxt']) ? trim($_GET['pesquisaTxt']) : '';

$sql = "
    SELECT * FROM (
    (
        SELECT
            l.livro_cod AS id,
            l.livro_titulo AS nome,
            l.livro_capa_link AS imagem,
            'livro' AS tipo
        FROM Livros l
        WHERE
            (l.livro_titulo LIKE CONCAT('%', :pesquisa, '%')
            OR l.livro_descricao LIKE CONCAT('%', :pesquisa, '%'))
            AND l.livro_ativo = TRUE
    )
    UNION ALL
    (
        SELECT
            a.autor_cod AS id,
            a.autor_nome AS nome,
            a.autor_link_foto AS imagem,
            'autor' AS tipo
        FROM Autor a
        WHERE
            (a.autor_nome LIKE CONCAT('%', :pesquisa, '%')
            OR a.autor_biografia LIKE CONCAT('%', :pesquisa, '%')
            OR a.autor_movimento_literario LIKE CONCAT('%', :pesquisa, '%'))
            AND a.autor_ativo = TRUE
    )
) AS resultados
LIMIT 10;

";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':pesquisa', $pesquisa, PDO::PARAM_STR);
$stmt->execute();
$resultadosPesquisa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado Pesquisa</title>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/stylePesquisaResultado.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">

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
                <h2 class="titulo">Resultados</h2>
            </div>

        </div>
        <div class="containerResultadoPesquisa">

            <?php if (count($resultadosPesquisa) > 0){ ?>
            <?php foreach ($resultadosPesquisa as $resultado_pesquisa): ?>
            <?php if ($resultado_pesquisa['tipo'] === 'livro'): ?>
            <a href="pglivro.php?livro_cod=<?= $resultado_pesquisa['id'] ?>">
                <?php else: ?>
                <a href="pgautor.php?autor_cod=<?= $resultado_pesquisa['id'] ?>">
                    <?php endif; ?>
                    <div class="cartao">
                        <div class="capa">
                            <img src="<?= htmlspecialchars($resultado_pesquisa['imagem']) ?>" class="imagem-capa">
                        </div>
                        <div class="informacoes">
                            <div class="titulo">
                                <?= htmlspecialchars($resultado_pesquisa['nome']) ?>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
                <?php }else{ ?>
                <div class="mensagem-vazia">
                    <h2>Nenhum resultado encontrado</h2>
                    <p>Não encontramos livros ou autores correspondentes à sua pesquisa.</p>
                    <a href="pgHome.php">Voltar à Página Inicial</a>
                </div>
                <?php
                }?>
        </div>
    </div>

    <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
    ?>

</body>

</html>