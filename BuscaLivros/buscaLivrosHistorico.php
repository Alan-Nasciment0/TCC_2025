<?php
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';
$usuarioCod = $_SESSION['usuario_cod'];

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {

  // Consulta todos os livros
  $sql = "SELECT 
    DATE_FORMAT(h.historico_data_hora, '%d/%m/%Y') AS dia_formatado,
    l.livro_cod,
    l.livro_titulo,
    l.livro_ano,
    l.livro_editora,
    l.livro_descricao,
    l.livro_capa_link,
    GROUP_CONCAT(DISTINCT a.autor_nome SEPARATOR ', ') AS autor_nome,
    GROUP_CONCAT(DISTINCT g.genero_nome SEPARATOR ', ') AS genero_nome
    FROM Historico_Visualizacao AS h
    JOIN Livros AS l ON h.livro_cod = l.livro_cod
    JOIN AutorLivro AS al ON l.livro_cod = al.livro_cod
    JOIN Autor AS a ON al.autor_cod = a.autor_cod
    LEFT JOIN LivroGenero AS lg ON l.livro_cod = lg.livro_cod
    LEFT JOIN Genero AS g ON lg.genero_cod = g.genero_cod
    WHERE h.usuario_cod = :usuario_cod
    GROUP BY DATE(h.historico_data_hora), l.livro_cod
    ORDER BY h.historico_data_hora DESC;";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':usuario_cod', $usuarioCod, PDO::PARAM_INT);
  $stmt->execute();
  $historico_visualizacao_usuario = $stmt->fetchAll(); 
  
 
} catch (PDOException $e) {
  die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}