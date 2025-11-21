<?php
include('../conexao_bd_sql/conexao_bd_mysql.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("SELECT 
    usuario_cod AS usuario_cod_pesquisado,
    usuario_nome AS nome_usuario_pesquisado,
    usuario_email AS email_usuario_pesquisado,
    foto_perfil_usuario AS foto_usuario_pesquisado,
    nivel_acesso as nivel_acesso_pesquisado
FROM usuario
WHERE usuario_cod = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    // Ajusta caminho da imagem
    $usuario['foto_usuario_pesquisado'] = "../img/foto_perfil_usuario/" . $usuario['foto_usuario_pesquisado'];
}

header('Content-Type: application/json');
echo json_encode($usuario);
