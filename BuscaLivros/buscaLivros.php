<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {

  // Consulta todos os livros
  $sql = " SELECT 
    l.livro_cod,
    l.livro_titulo,
    l.livro_capa_link,
    l.livro_editora,
    l.livro_ano,
    l.livro_descricao,
    a.autor_nome,
    g.genero_nome
FROM livros l
LEFT JOIN autorLivro al ON l.livro_cod = al.livro_cod
LEFT JOIN autor a ON al.autor_cod = a.autor_cod
LEFT JOIN livroGenero lg ON l.livro_cod = lg.livro_cod
LEFT JOIN genero g ON lg.genero_cod = g.genero_cod
ORDER BY l.livro_titulo;
";
    
  $stmt = $pdo->query($sql);
  $livrosRaw = $stmt->fetchAll();

    // Organiza os dados para agrupar múltiplos autores por livro
    $informacoes_livros = [];

    foreach ($livrosRaw as $row) {
        $livroCod = $row['livro_cod'];

        if (!isset($informacoes_livros[$livroCod])) {
            $informacoes_livros[$livroCod] = [
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
            $informacoes_livros[$livroCod]['autores'][] = $row['autor_nome'];
        }
    }
    foreach ($informacoes_livros as &$livro) {
    $livro['autor_nome'] = implode(', ', $livro['autores']); // junta os autores em uma string
    }
    unset($livro);
 
} catch (PDOException $e) {
  die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}