<?php
session_start();
require __DIR__ . '/../conexao_bd_sql/conexao_bd_mysql.php';

$usuario_cod_pesquisado = $_POST['usuario_cod_pesquisado'];

$sql = "select nivel_acesso from usuario where usuario_cod = :usuario_cod_pesquisado;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario_cod_pesquisado', $usuario_cod_pesquisado, PDO::PARAM_INT);
            $stmt->execute();
            $nivelAcessoUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['adicionarModerador']) && $nivelAcessoUsuario['nivel_acesso'] == 1) {     
    
    if(empty($usuario_cod_pesquisado)){
        $_SESSION['usuarioSelecionado'] = false;
        header('Location: ../paginas_tcc/pgAdicionarModerador.php');
    exit;
    }

    try {
        
        $sql = "UPDATE usuario SET nivel_acesso = 2 WHERE (usuario_cod = :usuario_cod_selecionado)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario_cod_selecionado', $usuario_cod_pesquisado);
        $stmt->execute();
        $_SESSION['moderadorAdicionado'] = true;

    } catch (PDOException $e) {
        echo "Erro ao adicionar comentário: " . $e->getMessage();
    }

    header('Location: ../paginas_tcc/pgAdicionarModerador.php');
    exit;
}

if (isset($_POST['removerModerador']) && $nivelAcessoUsuario['nivel_acesso'] == 2) {     
    
    if(empty($usuario_cod_pesquisado)){
        $_SESSION['usuarioSelecionado'] = false;
        header('Location: ../paginas_tcc/pgAdicionarModerador.php');
    exit;
    }

    try {
        
        $sql = "UPDATE usuario SET nivel_acesso = 1 WHERE (usuario_cod = :usuario_cod_selecionado)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario_cod_selecionado', $usuario_cod_pesquisado);
        $stmt->execute();
        $_SESSION['moderadorRemovido'] = true;

    } catch (PDOException $e) {
        echo "Erro ao adicionar comentário: " . $e->getMessage();
    }

    header('Location: ../paginas_tcc/pgAdicionarModerador.php');
    exit;
}
    header('Location: ../paginas_tcc/pgAdicionarModerador.php');
    exit;
?>
