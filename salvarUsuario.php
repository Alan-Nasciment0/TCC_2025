<?php
session_start();
require 'conecao_bd_sql/conexao_bd_mysql.php';

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

    header('Location: paginas_tcc/pgLogin.php');
    exit;
}
if (isset($_POST['login'])) {
    // Recebe os dados do formulário
    $email = mysqli_real_escape_string($conexao_servidor_bd, trim($_POST['email']));
    $senha = trim($_POST['senha']);

    // Verifica se o usuário existe
    $sql = "SELECT usuario_cod, usuario_nome, usuario_email, usuario_senha FROM usuario WHERE usuario_email = ?";
    $stmt = mysqli_prepare($conexao_servidor_bd, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Verifica se encontrou o usuário
        if (mysqli_stmt_num_rows($stmt) === 1) {
            mysqli_stmt_bind_result($stmt, $id, $nome, $email_banco, $senha_hash);
            mysqli_stmt_fetch($stmt);

            // Verifica a senha com password_verify
            if (password_verify($senha, $senha_hash)) {
                // Login bem-sucedido
                $_SESSION['usuario_cod'] = $id;
                $_SESSION['usuario_nome'] = $nome;
                $_SESSION['logado'] = true;

                header('Location: area_restrita.php'); // página pós-login
                exit;
            } else {
                $_SESSION['mensagem'] = "Senha incorreta.";
            }
        } else {
            $_SESSION['mensagem'] = "Usuário não encontrado.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['mensagem'] = "Erro na consulta: " . mysqli_error($conexao_servidor_bd);
    }

    header('Location: paginas_tcc/pgHome.php');
    exit;
}
?>
