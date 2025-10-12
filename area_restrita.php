<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] == true) {
    header('Location: paginas_tcc/pgHome.php');
    exit;
}
else {
    header('Location: index.php');
    exit;
}
?>