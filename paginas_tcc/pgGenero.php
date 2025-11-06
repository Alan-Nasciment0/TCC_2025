<?php
session_start();
require '../conexao_bd_sql/conexao_bd_mysql.php';

// Pegar categorias vindas da URL
$categorias = $_GET['categorias'] ?? '';
$categorias_array = explode(',', $categorias);

$placeholders = implode(',', array_fill(0, count($categorias_array), '?'));

$sql = "SELECT genero_cod, genero_nome FROM genero WHERE categoria_cod IN ($placeholders)";
$stmt = $pdo->prepare($sql);
$stmt->execute($categorias_array);
$generos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gêneros de Livros</title>
  <link rel="stylesheet" href="../css_js/css/styleGeneroLivro.css">
</head>
<body>
  <div class="container">
    <h2>Escolha seus gêneros favoritos</h2>
    <p>Usamos seus gêneros favoritos para recomendações personalizadas.</p>

    <form action="../salvarPreferencias/salvarPreferencias.php" method="post">
      <div class="opcoes">
        <?php foreach ($generos as $g): ?>
          <label class="opcao">
            <input type="checkbox" name="generoPreferencia[]" value="<?= htmlspecialchars($g['genero_cod']) ?>">
            <?= htmlspecialchars($g['genero_nome']) ?>
          </label>
        <?php endforeach; ?>
      </div>

      <button class="btn" name="salvar_genero">Próxima página</button>
    </form>
  </div>
</body>
</html>
