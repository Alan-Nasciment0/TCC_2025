<?php
header('Content-Type: application/json');
session_start();

try {
    // Verifica login
    if (!isset($_SESSION['usuario_cod'])) {
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Usuário não está logado!'
        ]);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    $usuario_id = $_SESSION['usuario_cod'];
    $motivo = $data['motivo'] ?? '';
    $descricao = $data['descricao'] ?? '';
    $idComentario = $data['id_comentario'] ?? 0;

    if (!$motivo || !$descricao || !$idComentario) {
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Dados incompletos!'
        ]);
        exit;
    }

    include "../conexao_bd_sql/conexao_bd_mysql.php";

    // Verifica se já denunciou
    $stmtCheck = $pdo->prepare("
        SELECT COUNT(*) FROM denuncia 
        WHERE usuario_cod = :usuario_id AND comentario_cod = :comentario_id
    ");
    $stmtCheck->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmtCheck->bindValue(':comentario_id', $idComentario, PDO::PARAM_INT);
    $stmtCheck->execute();

    if ($stmtCheck->fetchColumn() > 0) {
        echo json_encode([
            'status' => 'ja_denunciado',
            'mensagem' => 'Você já denunciou este comentário!'
        ]);
        exit;
    }

    // Insere denúncia
    $stmt = $pdo->prepare("
        INSERT INTO denuncia (usuario_cod, comentario_cod, motivo, descricao) 
        VALUES (:usuario_id, :comentario_id, :motivo, :descricao)
    ");
    $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->bindValue(':comentario_id', $idComentario, PDO::PARAM_INT);
    $stmt->bindValue(':motivo', $motivo);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->execute();

    echo json_encode([
        'status' => 'sucesso',
        'mensagem' => 'Denúncia enviada com sucesso!'
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro ao salvar denúncia: ' . $e->getMessage()
    ]);
    exit;
} catch (Exception $e) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro inesperado: ' . $e->getMessage()
    ]);
    exit;
}
