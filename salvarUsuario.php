<?php
session_start();
require 'conexao_bd_mysql.php';

if (isset($_POST['Criar_conta'])) {
    // Limpar e proteger os dados
    $nome = mysqli_real_escape_string($conexao_servidor_bd, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao_servidor_bd, trim($_POST['email']));
    $senha = isset($_POST['senha']) ? password_hash(trim($_POST['senha']), PASSWORD_DEFAULT) : '';

    // Usando prepared statement para maior segurança
    $stmt = mysqli_prepare($conexao_servidor_bd, "INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha) VALUES (?, ?, ?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['mensagem'] = 'Usuário criado com sucesso';
        } else {
            $_SESSION['mensagem'] = 'Usuário não foi criado';
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['mensagem'] = 'Erro ao preparar a query';
    }

    header('Location: index.php');
    exit;
}
?>
