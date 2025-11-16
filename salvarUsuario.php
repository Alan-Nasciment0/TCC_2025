<?php
session_start();
require 'conexao_bd_sql/conexao_bd_mysql.php'; // $pdo é criado aqui

if (isset($_POST['pgCriar_conta'])) {
    header('Location: paginas_tcc/pgCadastro.php');
    exit;
}

if (isset($_POST['Criar_conta'])) {
    // Limpar os dados
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmaSenha = trim($_POST['confirmaSenha']);

    if($nome == ""){
        $_SESSION['nomeVazio'] = true;
        header('Location: paginas_tcc/pgCadastro.php');
        exit;
    }

    if($email == ""){
        $_SESSION['emailVazio'] = true;
        header('Location: paginas_tcc/pgCadastro.php');
        exit;
    }

    if($senha == ""){
        $_SESSION['senhaVazia'] = true;
        header('Location: paginas_tcc/pgCadastro.php');
        exit;
    }

    if($confirmaSenha == $senha){
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    }else {
        $_SESSION['senhaDiferentes'] = true;
        header('Location: paginas_tcc/pgCadastro.php');
        exit;
    }
    
    $sql = "SELECT usuario_email FROM usuario WHERE usuario_email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $emailVerificacao = $stmt->fetch(PDO::FETCH_ASSOC);

    if($emailVerificacao) {    
    $_SESSION['emailExistente'] = true;
    header("Location: paginas_tcc/pgCadastro.php");
    exit;
    }

    try {
    $sql = "INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);

        if ($stmt->execute()) {
            $_SESSION['mensagem'] = 'Usuário criado com sucesso.';
            $_SESSION['contaCadastrada'] = true;
            header("Location: paginas_tcc/pgCadastro.php");
        } else {
            $_SESSION['mensagem'] = 'Não foi possível criar o usuário.';
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION['contaCadastrada'] = true;
        $_SESSION['mensagem'] = "Erro no banco: " . $e->getMessage();
    }

    header('Location: paginas_tcc/pgCadastro.php');
    exit;
}


if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if($email == ""){
        $_SESSION['emailVazio'] = true;
        header('Location: paginas_tcc/pgLogin.php');
        exit;
    }

    if($senha == ""){
        $_SESSION['senhaVazia'] = true;
        header('Location: paginas_tcc/pgLogin.php');
        exit;
    }

    $sql = "SELECT usuario_email FROM usuario WHERE usuario_email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $emailVerificacao = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$emailVerificacao) {    
    $_SESSION['emailErrado'] = true;
    header('Location: paginas_tcc/pgLogin.php');
    exit;
    }

    try {
        $sql = "SELECT usuario_cod, usuario_nome, usuario_email, usuario_senha, nivel_acesso, primeiro_acesso 
                FROM usuario 
                WHERE usuario_email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($senha, $usuario['usuario_senha'])) {
                // Login bem-sucedido
                $_SESSION['usuario_cod'] = $usuario['usuario_cod'];
                $_SESSION['usuario_nome'] = $usuario['usuario_nome'];
                $_SESSION['logado'] = true;
                $_SESSION['nivel_acesso'] = $usuario['nivel_acesso'];
                $_SESSION['primeiro_acesso'] = $usuario['primeiro_acesso'];

                header('Location: area_restrita.php');
                exit;
            } else {
                $_SESSION['mensagem'] = "Senha incorreta.";
                $_SESSION['senhaErrada'] = true;
                header('Location: paginas_tcc/pgLogin.php');
                exit;
            }
        } else {
            $_SESSION['mensagem'] = "Usuário não encontrado.";
             header('Location: paginas_tcc/pgLogin.php');
                exit;
        }

    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro na consulta: " . $e->getMessage();
    }

    header('Location: paginas_tcc/pgHome.php');
    exit;
}
?>
