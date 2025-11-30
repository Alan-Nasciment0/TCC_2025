<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';
session_start();

// Moderador logado
$moderador_cod = $_SESSION['usuario_cod'] ?? null;

if (!$moderador_cod) {
    echo "Usuário não autenticado.";
    exit;
}

// Dados enviados via POST
$usuario_cod = $_POST['usuario_cod'] ?? null;
$duracao = $_POST['duracao'] ?? null;
$motivo = $_POST['motivo'] ?? "Comentário inapropriado";
$denuncia_cod = $_POST['denuncia_cod'] ?? null;


if (!$usuario_cod || !$duracao) {
    echo "Dados incompletos.";
    exit;
}

// Definir datas
$data_inicio = date('Y-m-d H:i:s');

if ($duracao === 'Ignorar') {
   
    $sqlUpdate = "UPDATE Denuncia SET status = 0 WHERE denuncia_cod = :denuncia_cod";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->execute([':denuncia_cod' => $denuncia_cod]);
    echo "Denúncia ignorada com sucesso!";
    exit;
} else {
    // Converter duração em dias
    $dias = match($duracao) {
        '3 Dias' => 3,
        '7 Dias' => 7,
        '14 Dias' => 14,
        default => 0
    };
    $data_fim = date('Y-m-d H:i:s', strtotime("+$dias days"));
}

// Inserir na tabela Banimentos
$sql = "INSERT INTO Banimentos (usuario_cod, moderador_cod, motivo, data_inicio, data_fim, tipo)
        VALUES (:usuario_cod, :moderador_cod, :motivo, :data_inicio, :data_fim, :tipo)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':usuario_cod' => $usuario_cod,
    ':moderador_cod' => $moderador_cod,
    ':motivo' => $motivo,
    ':data_inicio' => $data_inicio,
    ':data_fim' => $data_fim,
    ':tipo' => 'comentario'
]);

$stmtUpdateBanido = $pdo->prepare("UPDATE Denuncia SET status = 0 WHERE denuncia_cod = :denuncia_cod");
$stmtUpdateBanido->execute([':denuncia_cod' => $denuncia_cod]);

echo "Banimento registrado com sucesso!";
