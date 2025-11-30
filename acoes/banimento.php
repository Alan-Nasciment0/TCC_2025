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

if (!$usuario_cod || !$duracao) {
    echo "Dados incompletos.";
    exit;
}

// Definir datas
$data_inicio = date('Y-m-d H:i:s');

if ($duracao === 'permanente') {
    $data_fim = null;
} else {
    // Converter duração em dias
    switch ($duracao) {
        case '3 Dias': $dias = 3; break;
        case '7 Dias': $dias = 7; break;
        case '14 Dias': $dias = 14; break;
        default: $dias = 0;
    }
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

echo "Banimento registrado com sucesso!";
