<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {

  // Consulta todos os livros
  $sql = "WITH book_ratings AS (
    SELECT 
        a.livro_cod,
        COUNT(*) AS total_avaliacoes,
        AVG(a.nota) AS media_notas
    FROM Avaliacoes a
    GROUP BY a.livro_cod
    )
    SELECT 
        l.livro_cod,
        l.livro_titulo,
        l.livro_capa_link,
        GROUP_CONCAT(DISTINCT au.autor_nome SEPARATOR ', ') AS autor_nome,
        br.total_avaliacoes,
        br.media_notas
    FROM Livros l
    LEFT JOIN AutorLivro al ON al.livro_cod = l.livro_cod
    LEFT JOIN Autor au ON au.autor_cod = al.autor_cod
    LEFT JOIN book_ratings br ON br.livro_cod = l.livro_cod
    GROUP BY l.livro_cod, l.livro_titulo, l.livro_capa_link, br.total_avaliacoes, br.media_notas
    ORDER BY br.total_avaliacoes DESC, br.media_notas DESC
    LIMIT 10;";
  $stmt = $pdo->prepare($sql);  
  $stmt->execute();
  $livros_ranking = $stmt->fetchAll(); 
  
 
} catch (PDOException $e) {
  die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}