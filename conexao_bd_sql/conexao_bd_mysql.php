<?php

$local_servidor = "localhost:3307";
$usuario = "root";
$senha = "";

$bd_procurado = "bd_TCC";

try {
    $pdo = new PDO("mysql:host=$local_servidor;dbname=$bd_procurado;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}               
?>
