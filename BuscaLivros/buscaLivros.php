<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {

  // Consulta todos os produtos
  $stmt = $pdo->query("SELECT * FROM livros");
  $livros = $stmt->fetchAll();

} catch (PDOException $e) {
  die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}