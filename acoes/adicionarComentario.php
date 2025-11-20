<?php
session_start();
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';


if (isset($_POST['btnComentar'])) {
    // Verifica se há um usuário logado
    if (!isset($_SESSION['usuario_cod'])) {
        echo "Usuário não logado.";
        exit;
    }

    $usuario_cod = $_SESSION['usuario_cod'];
    $livro_cod = $_POST['livro_cod'] ?? null;
    $txtComentario =$_POST['txtComentario'];

    if (!$livro_cod) {
        echo "Livro não informado.";
        exit;
    }

    try {
        
        $sql = "INSERT INTO comentario (usuario_cod, livro_cod, comentario_texto) VALUES (:usuario_cod, :livro_cod, :txtComentario)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':livro_cod', $livro_cod);
        $stmt->bindParam(':usuario_cod', $usuario_cod);
        $stmt->bindParam(':txtComentario', $txtComentario);
        $stmt->execute();

    } catch (PDOException $e) {
        echo "Erro ao adicionar comentário: " . $e->getMessage();
    }

    header('Location: ../paginas_tcc/pgLivro.php?livro_cod='.$livro_cod);
    exit;
}
?>
