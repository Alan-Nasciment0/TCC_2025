<?php
include('../conexao_bd_sql/conexao_bd_mysql.php');

$categoria = $_GET['categoria'];
$pesquisa = $_GET['pesquisaGenero'] ?? '';

$sql = $pdo->prepare("SELECT * FROM genero 
                      WHERE categoria_cod = ? 
                      AND genero_nome LIKE ?
                      LIMIT 6");
$sql->execute([$categoria, "%$pesquisa%"]);

while ($g = $sql->fetch()) {
    echo "<div class='resultado-item-genero' data-id='{$g['genero_cod']}'  style='padding: 5px; cursor: pointer;'>
            {$g['genero_nome']}
          </div>";
}
?>
