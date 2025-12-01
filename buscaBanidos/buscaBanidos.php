<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';


$sql = "
 SELECT 
    u.usuario_cod,
    u.usuario_nome,
    MAX(b.data_fim) AS data_expiracao
FROM Banimentos b
JOIN Usuario u ON b.usuario_cod = u.usuario_cod
WHERE b.tipo = 'comentario'
  AND (b.data_fim IS NULL OR b.data_fim > NOW())
GROUP BY u.usuario_cod, u.usuario_nome
ORDER BY data_expiracao ASC;
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$banidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

