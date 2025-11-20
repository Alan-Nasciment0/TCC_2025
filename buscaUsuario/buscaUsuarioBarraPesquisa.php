<?php
include('../conexao_bd_sql/conexao_bd_mysql.php');


$pesquisa = $_GET['pesquisaUsuario'] ?? '';

$stmt = $pdo->prepare(" SELECT 
    usuario_cod,
    usuario_nome AS nome_usuario_pesquisado,
    usuario_email AS email_usuario_pesquisado,
    foto_perfil_usuario AS foto_usuario_pesquisado
FROM usuario
WHERE usuario_nome LIKE ?
LIMIT 6");
$stmt->execute(["%$pesquisa%"]);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($usuarios) {
        foreach ($usuarios as $usuario) {
            echo '<div class="resultado-item-usuario" data-id="' . $usuario['usuario_cod'] . '" style="display: flex; align-items: center; gap: 10px; cursor: pointer;">';
            echo '<img src="../img/foto_perfil_usuario/' . htmlspecialchars($usuario['foto_usuario_pesquisado']) . '" alt="Foto do Usuário" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">';
            echo '<span class="textoLista">' . htmlspecialchars($usuario['nome_usuario_pesquisado']) . '</span>';
            echo '</div>';
        }
    } else {
        echo '<div class="resultado-item">Nenhum usuário encontrado</div>';
    }
?>
