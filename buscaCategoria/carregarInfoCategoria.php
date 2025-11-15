<?php
include('../conexao_bd_sql/conexao_bd_mysql.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM categoria WHERE categoria_cod = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$autor = $stmt->fetch(PDO::FETCH_ASSOC);

if ($autor) {
    echo json_encode($autor);
} else {
    echo json_encode([]);
}
?>
