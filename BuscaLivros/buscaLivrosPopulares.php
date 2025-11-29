<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {

  
  $sql = "SELECT
    l.livro_cod,
    l.livro_titulo,
    l.livro_ano,
    l.livro_editora,
    l.livro_descricao,
    l.livro_capa_link,

    GROUP_CONCAT(DISTINCT a.autor_nome SEPARATOR ', ') AS autor_nome,
    GROUP_CONCAT(DISTINCT g.genero_nome SEPARATOR ', ') AS genero_nome,

    -- número de avaliações
    COUNT(av.avaliacao_cod) AS v,

    -- média das avaliações
    AVG(av.nota) AS R,

    -- média geral de todos os livros (C)
    (
        SELECT AVG(nota) 
        FROM Avaliacoes
    ) AS C,

    -- valor mínimo de avaliações para relevância (m)
    5 AS m,

    -- Weighted Rating (modelo IMDb)
    CASE
        WHEN COUNT(av.avaliacao_cod) = 0 THEN 0
        ELSE (
            (COUNT(av.avaliacao_cod) / (COUNT(av.avaliacao_cod) + 5)) * AVG(av.nota) +
            (5 / (COUNT(av.avaliacao_cod) + 5)) * (
                SELECT AVG(nota)
                FROM Avaliacoes
            )
        )
    END AS weighted_rating

FROM Livros l
LEFT JOIN AutorLivro al ON al.livro_cod = l.livro_cod
LEFT JOIN Autor a ON a.autor_cod = al.autor_cod
LEFT JOIN LivroGenero lg ON lg.livro_cod = l.livro_cod
LEFT JOIN Genero g ON g.genero_cod = lg.genero_cod
LEFT JOIN Avaliacoes av ON av.livro_cod = l.livro_cod

GROUP BY
    l.livro_cod,
    l.livro_titulo,
    l.livro_ano,
    l.livro_editora,
    l.livro_descricao,
    l.livro_capa_link

ORDER BY weighted_rating DESC
LIMIT 12;
";

  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $livrosRaw = $stmt->fetchAll();

    // Organiza os dados para agrupar múltiplos autores por livro
    $livros_populares = [];

    foreach ($livrosRaw as $row) {
        $livroCod = $row['livro_cod'];

        if (!isset($livros_populares[$livroCod])) {
            $livros_populares[$livroCod] = [
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
            $livros_populares[$livroCod]['autores'][] = $row['autor_nome'];
        }
    }
    foreach ($livros_populares as &$livro) {
    $livro['autor_nome'] = implode(', ', $livro['autores']); // junta os autores em uma string
    }
    unset($livro);
 
} catch (PDOException $e) {
  die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}