<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {

  
  $sql = "SELECT 
    L2.livro_cod,
    L2.livro_titulo,
    L2.livro_ano,
    L2.livro_editora,
    L2.livro_descricao,
    L2.livro_capa_link,
    L2.livro_ativo,
    -- Gêneros do livro recomendado
    GROUP_CONCAT(DISTINCT G2.genero_nome SEPARATOR ', ') AS genero_nome,
    -- Autores do livro recomendado
    GROUP_CONCAT(DISTINCT A2.autor_nome SEPARATOR ', ') AS autor_nome,
    -- Peso da recomendação
    (
        CASE WHEN G1.genero_cod IS NOT NULL THEN 1 ELSE 0 END +
        CASE WHEN A1.autor_cod IS NOT NULL THEN 1 ELSE 0 END +
        CASE WHEN C1.categoria_cod IS NOT NULL THEN 1 ELSE 0 END
    ) AS peso
FROM Livros L2
-- GÊNEROS DO LIVRO RECOMENDADO
LEFT JOIN LivroGenero LG2 ON L2.livro_cod = LG2.livro_cod
LEFT JOIN Genero G2 ON LG2.genero_cod = G2.genero_cod
-- COMPARAÇÃO DE GÊNEROS COM O LIVRO BASE
LEFT JOIN LivroGenero LG1 
    ON LG1.livro_cod = :livro_cod 
    AND LG1.genero_cod = LG2.genero_cod
LEFT JOIN Genero G1 ON LG1.genero_cod = G1.genero_cod
-- AUTORES DO LIVRO RECOMENDADO
LEFT JOIN AutorLivro AL2 ON L2.livro_cod = AL2.livro_cod
LEFT JOIN Autor A2 ON AL2.autor_cod = A2.autor_cod
-- COMPARAÇÃO DE AUTORES COM O LIVRO BASE
LEFT JOIN AutorLivro AL1 
    ON AL1.livro_cod = :livro_cod 
    AND AL1.autor_cod = AL2.autor_cod
LEFT JOIN Autor A1 ON AL1.autor_cod = A1.autor_cod
-- CATEGORIA DO LIVRO RECOMENDADO
LEFT JOIN LivroCategoria LC2 ON L2.livro_cod = LC2.livro_cod
-- CATEGORIA DO LIVRO BASE
LEFT JOIN LivroCategoria LC1 
    ON LC1.livro_cod = :livro_cod 
    AND LC1.categoria_cod = LC2.categoria_cod
LEFT JOIN Categoria C1 ON LC1.categoria_cod = C1.categoria_cod
WHERE L2.livro_cod <> :livro_cod 
GROUP BY L2.livro_cod
ORDER BY peso DESC, L2.livro_titulo ASC
LIMIT 12;
";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':livro_cod', $livro_cod, PDO::PARAM_INT);
  $stmt->execute();
  $livrosMesmoAutorRaw = $stmt->fetchAll();

    // Organiza os dados para agrupar múltiplos autores por livro
    $livros_recomendadosAutorGeneroCategoria = [];

    foreach ($livrosMesmoAutorRaw as $row) {
        $livroCod = $row['livro_cod'];

        if (!isset($livros_recomendadosAutorGeneroCategoria[$livroCod])) {
            $livros_recomendadosAutorGeneroCategoria[$livroCod] = [
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
            $livros_recomendadosAutorGeneroCategoria[$livroCod]['autores'][] = $row['autor_nome'];
        }
    }
    foreach ($livros_recomendadosAutorGeneroCategoria as &$livroAutorGeneroCategoria) {
    $livroAutorGeneroCategoria['autor_nome'] = implode(', ', $livroAutorGeneroCategoria['autores']); // junta os autores em uma string
    }
    unset($livroAutorGeneroCategoria);
 
} catch (PDOException $e) {
  die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}