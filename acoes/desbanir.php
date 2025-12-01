<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';
session_start();

// Só moderador/admin pode desbanir
$moderador_cod = $_SESSION['usuario_cod'] ?? null;
if (!$moderador_cod) {
    echo "Usuário não autenticado.";
    exit;
}

$usuario_cod = $_POST['usuario_cod'] ?? null;
if (!$usuario_cod) {
    echo "Usuário não definido.";
    exit;
}

// Atualiza banimentos para remover
$sql = "UPDATE Banimentos SET data_fim = NOW() WHERE usuario_cod = :usuario_cod AND (data_fim IS NULL OR data_fim > NOW())";
$stmt = $pdo->prepare($sql);
$stmt->execute([':usuario_cod' => $usuario_cod]);

echo "Usuário desbanido com sucesso!";
