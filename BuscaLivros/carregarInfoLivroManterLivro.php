<?php
include('../conexao_bd_sql/conexao_bd_mysql.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT 
    l.livro_cod,
    l.livro_titulo,
    l.livro_capa_link,
    l.livro_editora,
    l.livro_ano,
    l.livro_descricao,
    GROUP_CONCAT(DISTINCT a.autor_nome SEPARATOR ', ') AS autor_nome,
    GROUP_CONCAT(DISTINCT g.genero_nome SEPARATOR ', ') AS genero_nome,
    GROUP_CONCAT(DISTINCT c.categoria_nome SEPARATOR ', ') AS categoria_nome
FROM livros l
LEFT JOIN autorLivro al ON l.livro_cod = al.livro_cod
LEFT JOIN autor a ON al.autor_cod = a.autor_cod
LEFT JOIN livroGenero lg ON l.livro_cod = lg.livro_cod
LEFT JOIN genero g ON lg.genero_cod = g.genero_cod
LEFT JOIN categoria c ON g.categoria_cod = c.categoria_cod
WHERE l.livro_cod = :id
GROUP BY l.livro_cod;";

$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$livro = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($livro ?: []);
?>