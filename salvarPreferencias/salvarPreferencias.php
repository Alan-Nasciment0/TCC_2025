<?php
session_start();
require '../conexao_bd_sql/conexao_bd_mysql.php'; // $pdo é criado aqui

if (isset($_POST['salvar_categoria'])) {
    // Limpar os dados
    $usuarioCod = $_SESSION['usuario_cod'];
    $preferencia_categoria = trim($_POST['categoriaPreferencia']);
    
    try {
        $sql = "INSERT INTO categoria_preferida_usuario (usuario_cod, categoria_cod) VALUES (:usuario_cod, :categoriaPreferencia)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario_cod', $usuarioCod);
        $stmt->bindParam(':categoriaPreferencia', $preferencia_categoria);
        
        if ($stmt->execute()) {
            $_SESSION['mensagem'] = "Categoria salva com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Não foi possível salvar a categoria.";
        }
        
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro no banco: " . $e->getMessage();
    }

    header('Location: ../paginas_tcc/pgHome.php');
    exit;
}

if (isset($_POST['salvar_genero'])) {
    // Limpar os dados
    $usuarioCod = $_SESSION['usuario_cod'];
    $preferencia_genero = trim($_POST['generoPreferencia']);
    
    try {
        $sql = "INSERT INTO genero_preferido_usuario (usuario_cod, genero_cod) VALUES (:usuario_cod, :generoPreferencia)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario_cod', $usuarioCod);
        $stmt->bindParam(':generoPreferencia', $preferencia_genero);
        
        if ($stmt->execute()) {
            $_SESSION['mensagem'] = "Categoria salva com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Não foi possível salvar a categoria.";
        }
        
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro no banco: " . $e->getMessage();
    }

    header('Location: ../paginas_tcc/pgHome.php');
    exit;
}
?>