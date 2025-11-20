<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$livro_cod = $_GET['livro_cod'] ?? null;

$sql = "SELECT AVG(nota) AS media, COUNT(*) AS total_avaliacoes FROM Avaliacoes WHERE livro_cod = :livro_cod";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':livro_cod', $livro_cod, PDO::PARAM_INT);
$stmt->execute();
$mediaAvaliacao = $stmt->fetch(PDO::FETCH_ASSOC);

?>

