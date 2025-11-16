<?php
include('../conexao_bd_sql/conexao_bd_mysql.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT genero_nome, genero_cod FROM genero WHERE genero_cod = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$genero = $stmt->fetch(PDO::FETCH_ASSOC);

if ($genero) {
    echo json_encode($genero);
} else {
    echo json_encode([]);
}
?>
