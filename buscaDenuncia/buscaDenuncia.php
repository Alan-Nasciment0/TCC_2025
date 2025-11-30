<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';


$sql = "
  SELECT 
    d.denuncia_cod,
    u.usuario_cod,
    u.usuario_nome,
    u.foto_perfil_usuario,
    l.livro_titulo AS livro_nome,
    c.comentario_texto,
    d.denuncia_tipo AS motivo,
    COUNT(d.denuncia_cod) OVER (PARTITION BY u.usuario_cod) AS quantidade_denuncias
FROM Denuncia d
JOIN Comentario c ON d.comentario_cod = c.comentario_cod
JOIN Usuario u ON c.usuario_cod = u.usuario_cod
JOIN livros l ON c.livro_cod = l.livro_cod 
WHERE d.status = 1
ORDER BY d.denuncia_cod DESC;
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$denuncias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

