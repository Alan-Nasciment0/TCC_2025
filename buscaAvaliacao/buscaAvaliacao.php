<?php
header("Content-Type: application/json");

require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';


$sql = "SELECT COUNT(*) AS total FROM avaliacoes WHERE usuario_cod = :usuario_cod and livro_cod = :livro_cod";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario_cod', $_GET['usuario_cod']);
            $stmt->bindParam(':livro_cod', $_GET['livro_cod']);
            $stmt->execute();

echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
?>