<?php
session_start();
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

header('Content-Type: text/plain; charset=utf-8');

if (!isset($_SESSION['usuario_cod'])) {
    echo "⚠️ É necessário estar logado para avaliar.";
    exit;
}

$usuario_cod = $_SESSION['usuario_cod'];
$livro_cod = isset($_POST['livro_cod']) ? (int) $_POST['livro_cod'] : null;
$nota = isset($_POST['nota']) ? (int) $_POST['nota'] : null;

if (!$livro_cod || !$nota) {
    echo "❌ Dados incompletos.";
    exit;
}

if ($nota < 1 || $nota > 5) {
    echo "❌ Nota inválida.";
    exit;
}

try {
    // Verifica se já existe
    $sqlCheck = "SELECT avaliacao_cod FROM Avaliacoes WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':usuario_cod' => $usuario_cod, ':livro_cod' => $livro_cod]);

    if ($stmtCheck->rowCount() > 0) {
        $sql = "UPDATE Avaliacoes SET nota = :nota WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nota' => $nota, ':usuario_cod' => $usuario_cod, ':livro_cod' => $livro_cod]);
        echo "";
    } else {
        $sql = "INSERT INTO Avaliacoes (usuario_cod, livro_cod, nota) VALUES (:usuario_cod, :livro_cod, :nota)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':usuario_cod' => $usuario_cod, ':livro_cod' => $livro_cod, ':nota' => $nota]);
        echo ")";
    }
} catch (PDOException $e) {
    // Em desenvolvimento só: echo erro. Em produção logue em arquivo.
    echo "❌ Erro ao salvar avaliação: " . $e->getMessage();
}