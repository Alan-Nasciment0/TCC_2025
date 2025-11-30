<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';


$sql = "
    SELECT 
    u.usuario_cod,
    u.usuario_nome,
    l.livro_titulo,
    c.comentario_texto,
    d.denuncia_tipo AS motivo
FROM Denuncia d
JOIN Comentario c ON d.comentario_cod = c.comentario_cod
JOIN Usuario u ON c.usuario_cod = u.usuario_cod
JOIN livros l ON c.livro_cod = l.livro_cod
WHERE c.usuario_cod = 1    -- código do usuário
  AND c.livro_cod = 140;";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':livro_cod', $livro_cod_comentario);
$stmt->bindParam(':usuario_cod', $usuario_cod);
$stmt->execute();
$denuncias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

