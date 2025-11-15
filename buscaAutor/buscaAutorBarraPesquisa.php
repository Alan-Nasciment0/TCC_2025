<?php
include('../conexao_bd_sql/conexao_bd_mysql.php');

$termoPesquisa = isset($_GET['pesquisaAutor']) ? $_GET['pesquisaAutor'] : '';

if ($termoPesquisa !== '') {
    $sql = "SELECT  autor_cod, autor_nome, autor_link_foto FROM Autor WHERE autor_ativo = 1 and autor_nome LIKE :termoPesquisa ORDER BY autor_nome LIMIT 6";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':termoPesquisa' => "%$termoPesquisa%"]);
    $autores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($autores) {
        foreach ($autores as $autor) {
            echo '<div class="resultado-item" data-id="' . $autor['autor_cod'] . '" style="display: flex; align-items: center; gap: 10px;">';
            echo '<img src="' . htmlspecialchars($autor['autor_link_foto']) . '" alt="Foto do autor" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">';
            echo '<span>' . htmlspecialchars($autor['autor_nome']) . '</span>';
            echo '</div>';
        }
    } else {
        echo '<div class="resultado-item">Nenhum autor encontrado</div>';
    }
}
?>
