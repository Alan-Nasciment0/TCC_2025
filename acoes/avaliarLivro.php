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



try {
     // Verifica se o usuário já avaliou o livro
    $sqlCheck = "SELECT avaliacao_cod FROM avaliacoes WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([
        ':usuario_cod' => $usuario_cod,
        ':livro_cod' => $livro_cod
    ]);

    if ($nota === 0) {
    $sql = "DELETE FROM avaliacoes WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':usuario_cod' => $usuario_cod,
        ':livro_cod' => $livro_cod
    ]);
    echo "🗑️ Avaliação removida!";
    exit;
}


    $avaliacaoExistente = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($avaliacaoExistente) {
        // Atualiza a nota
        $sql = "UPDATE avaliacoes SET nota = :nota WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nota' => $nota,
            ':usuario_cod' => $usuario_cod,
            ':livro_cod' => $livro_cod
        ]);
        echo "✅ Avaliação atualizada!";
    } else {
        // Insere nova avaliação
        $sql = "INSERT INTO avaliacoes (usuario_cod, livro_cod, nota) VALUES (:usuario_cod, :livro_cod, :nota)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_cod' => $usuario_cod,
            ':livro_cod' => $livro_cod,
            ':nota' => $nota
        ]);
        echo "⭐ Avaliação registrada com sucesso!";
    }

} catch (PDOException $e) {
    echo "❌ Erro ao salvar avaliação: " . $e->getMessage();
}