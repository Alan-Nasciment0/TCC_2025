<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';


$sql = "
    SELECT 
    l.livro_cod,
    l.livro_titulo,
    l.livro_capa_link,
    l.livro_editora,
    l.livro_ano,
    l.livro_descricao,
    GROUP_CONCAT(DISTINCT a.autor_nome SEPARATOR ', ') AS autor_nome,
    GROUP_CONCAT(DISTINCT g.genero_nome SEPARATOR ', ') AS genero_nome
    FROM Livros_Lidos f
    JOIN livros l ON f.livro_cod = l.livro_cod
    LEFT JOIN autorLivro al ON l.livro_cod = al.livro_cod
    LEFT JOIN autor a ON al.autor_cod = a.autor_cod
    LEFT JOIN livroGenero lg ON l.livro_cod = lg.livro_cod
    LEFT JOIN genero g ON lg.genero_cod = g.genero_cod
    WHERE f.usuario_cod = :usuario_cod
    GROUP BY l.livro_cod, l.livro_titulo, l.livro_capa_link, l.livro_editora, l.livro_ano, l.livro_descricao
    ORDER BY l.livro_titulo;";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_cod', $usuario_cod, PDO::PARAM_INT);
$stmt->execute();
$livroslidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

