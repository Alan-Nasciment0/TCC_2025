<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {

  // Consulta todos os livros
  $sql = "WITH preferred_genres AS (
  
  SELECT genero_cod
  FROM Genero_preferido_usuario
  WHERE usuario_cod = :usuario_cod

  UNION

  
  SELECT lg.genero_cod
  FROM Favoritos f
  JOIN LivroGenero lg ON lg.livro_cod = f.livro_cod
  WHERE f.usuario_cod = :usuario_cod
),
user_read AS (
  
  SELECT livro_cod
  FROM Livros_Lidos
  WHERE usuario_cod = :usuario_cod
),
pop AS (
  
  SELECT livro_cod, COUNT(*) AS popularity
  FROM Livros_Lidos
  GROUP BY livro_cod
),
genre_match AS (
  
  SELECT lg.livro_cod, COUNT(DISTINCT lg.genero_cod) AS genre_matches
  FROM LivroGenero lg
  JOIN preferred_genres pg ON pg.genero_cod = lg.genero_cod
  GROUP BY lg.livro_cod
)
SELECT 
  l.livro_cod,
  l.livro_titulo,
  l.livro_ano,
  l.livro_editora,
  l.livro_descricao,
  l.livro_capa_link,
  GROUP_CONCAT(DISTINCT a.autor_nome SEPARATOR ', ') AS autor_nome,
  GROUP_CONCAT(DISTINCT g.genero_nome SEPARATOR ', ') AS genero_nome,
  COALESCE(gm.genre_matches, 0) AS genero_correspondencias,
  COALESCE(p.popularity, 0) AS popularidade
FROM Livros l
LEFT JOIN AutorLivro al ON al.livro_cod = l.livro_cod
LEFT JOIN Autor a ON a.autor_cod = al.autor_cod
LEFT JOIN LivroGenero lg ON lg.livro_cod = l.livro_cod
LEFT JOIN Genero g ON g.genero_cod = lg.genero_cod
LEFT JOIN genre_match gm ON gm.livro_cod = l.livro_cod
LEFT JOIN pop p ON p.livro_cod = l.livro_cod
WHERE l.livro_cod NOT IN (SELECT livro_cod FROM user_read)
GROUP BY 
  l.livro_cod,
  l.livro_titulo,
  l.livro_ano,
  l.livro_editora,
  l.livro_descricao,
  l.livro_capa_link,
  gm.genre_matches,
  p.popularity
ORDER BY
  COALESCE(gm.genre_matches, 0) DESC,   
  COALESCE(p.popularity, 0) DESC,       
  l.livro_ano DESC,                     
  RAND()                                
LIMIT 20;

";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':usuario_cod', $usuario_cod, PDO::PARAM_INT);
  $stmt->execute();
  $livrosRaw = $stmt->fetchAll();

    // Organiza os dados para agrupar múltiplos autores por livro
    $livros_recomendados = [];

    foreach ($livrosRaw as $row) {
        $livroCod = $row['livro_cod'];

        if (!isset($livros_recomendados[$livroCod])) {
            $livros_recomendados[$livroCod] = [
                'livro_cod' => $row['livro_cod'],
                'livro_titulo' => $row['livro_titulo'],
                'livro_capa_link' => $row['livro_capa_link'],
                'livro_editora' => $row['livro_editora'],
                'livro_descricao' => $row['livro_descricao'],
                'livro_ano' => $row['livro_ano'],
                'genero_nome' => $row['genero_nome'],
                'autores' => [], // array para múltiplos autores
            ];
        }

        if ($row['autor_nome']) {
            $livros_recomendados[$livroCod]['autores'][] = $row['autor_nome'];
        }
    }
    foreach ($livros_recomendados as &$livro) {
    $livro['autor_nome'] = implode(', ', $livro['autores']); // junta os autores em uma string
    }
    unset($livro);
 
} catch (PDOException $e) {
  die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}