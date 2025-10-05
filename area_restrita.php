<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: paginas_tcc/pgHome.php');
    exit;
}
?>

<h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
<a href="logout.php">Sair</a>
