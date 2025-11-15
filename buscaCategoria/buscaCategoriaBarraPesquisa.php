<?php
include('../conexao_bd_sql/conexao_bd_mysql.php');

$sql = "SELECT categoria_cod, categoria_nome FROM Categoria ORDER BY categoria_nome";
$stmt = $pdo->query($sql);
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($categorias as $categoria) {
    echo '<div class="resultado-item" data-id="' . $categoria['categoria_cod'] . '" style="padding: 5px; cursor: pointer;">';
    echo htmlspecialchars($categoria['categoria_nome']);
    echo '</div>';
}
?>
