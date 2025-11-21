<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$usuario_cod = $_SESSION['usuario_cod'];
$livro_cod = $_GET['livro_cod'] ?? null;

$sql = "
    SELECT 
        c.*,
        u.usuario_nome,
        u.foto_perfil_usuario,
        a.nota
    FROM comentario c
    JOIN usuario u ON c.usuario_cod = u.usuario_cod
    LEFT JOIN avaliacoes a ON c.usuario_cod = a.usuario_cod AND c.livro_cod = a.livro_cod
    WHERE c.livro_cod = :livro_cod
    ORDER BY (c.usuario_cod = :usuario_cod) DESC, c.comentario_cod DESC ";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':livro_cod', $livro_cod);
$stmt->bindParam(':usuario_cod', $usuario_cod);
$stmt->execute();
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

