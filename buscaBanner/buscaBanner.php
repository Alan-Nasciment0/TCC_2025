<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$sql = "SELECT * FROM noticias WHERE status = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$banners_ativos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

