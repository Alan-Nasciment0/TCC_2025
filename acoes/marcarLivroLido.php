<?php
session_start();
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se há um usuário logado
    if (!isset($_SESSION['usuario_cod'])) {
        echo "Usuário não logado.";
        exit;
    }

    $usuario_cod = $_SESSION['usuario_cod'];
    $livro_cod = $_POST['livro_cod'] ?? null;

    if (!$livro_cod) {
        echo "Livro não informado.";
        exit;
    }

    try {
        // Verifica se o livro já foi marcado como lido
        $verifica = $pdo->prepare("
            SELECT * FROM Livros_Lidos 
            WHERE usuario_cod = :usuario AND livro_cod = :livro
        ");
        $verifica->execute(['usuario' => $usuario_cod, 'livro' => $livro_cod]);

        if ($verifica->rowCount() > 0) {
            echo "📘 Este livro já foi marcado como lido.";
        } else {
            $stmt = $pdo->prepare("
                INSERT INTO Livros_Lidos (usuario_cod, livro_cod) 
                VALUES (:usuario, :livro)
            ");
            $stmt->execute(['usuario' => $usuario_cod, 'livro' => $livro_cod]);
            echo "✅ Livro marcado como lido com sucesso!";
        }
    } catch (PDOException $e) {
        echo "Erro ao marcar livro como lido: " . $e->getMessage();
    }
}
?>
