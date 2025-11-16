<?php
include('../conexao_bd_sql/conexao_bd_mysql.php');

$termoPesquisa = isset($_GET['pesquisaLivro']) ? $_GET['pesquisaLivro'] : '';

if ($termoPesquisa !== '') {
    $sql = "SELECT  livro_cod, livro_titulo, livro_capa_link FROM Livros WHERE livro_ativo = 1 and livro_titulo LIKE :termoPesquisa ORDER BY livro_titulo LIMIT 6";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':termoPesquisa' => "%$termoPesquisa%"]);
    $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($livros) {
        foreach ($livros as $livro) {
            echo '<div class="resultado-item-livro" data-id="' . $livro['livro_cod'] . '" style="display: flex; align-items: center; gap: 10px; cursor: pointer;">';
            echo '<img src="' . htmlspecialchars($livro['livro_capa_link']) . '" alt="Capa do Livro" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">';
            echo '<span class="textoLista">' . htmlspecialchars($livro['livro_titulo']) . '</span>';
            echo '</div>';
        }
    } else {
        echo '<div class="resultado-item">Nenhum livro encontrado</div>';
    }
}
?>
