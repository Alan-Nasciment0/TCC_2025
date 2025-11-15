<?php
session_start();
include('../conexao_bd_sql/conexao_bd_mysql.php');

$id = $_POST['autor_cod'];
$foto_autor =  $_POST['fotoAutor']; 
$nome_autor =  $_POST['nomeAutor'];
$data_nascimento_autor = $_POST['dataNascimentoAutor'];
$data_falecimento_autor = $_POST['dataFalecimentoAutor'];
$movimento_literario =  $_POST['movimentoLiterario'];
$biografia_autor =  $_POST['biografia'];

if ($data_falecimento_autor === "" || $data_falecimento_autor === null) {
    $data_falecimento_autor = null;
}
if ($data_nascimento_autor === "" || $data_nascimento_autor === null) {
    $data_nascimento_autor = null;
}

if (isset($_POST['adicionarAutor'])) {

    try {
        $sql = "INSERT INTO Autor 
        (autor_nome, autor_data_nascimento, autor_data_falecimento, autor_movimento_literario, autor_biografia, autor_link_foto)
        VALUES (:nome_autor, :autor_data_nascimento, :autor_data_falecimento, :autor_movimento_literario, :autor_biografia, :autor_link_foto )";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome_autor', $nome_autor);

        if ($data_nascimento_autor === null) {
            $stmt->bindValue(':autor_data_nascimento', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':autor_data_nascimento', $data_nascimento_autor);
        }

        if ($data_falecimento_autor === null) {
            $stmt->bindValue(':autor_data_falecimento', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':autor_data_falecimento', $data_falecimento_autor);
        }

        $stmt->bindParam(':autor_movimento_literario', $movimento_literario);
        $stmt->bindParam(':autor_biografia', $biografia_autor);
        $stmt->bindParam(':autor_link_foto', $foto_autor);

        if ($stmt->execute()) {
            $_SESSION['autorAdicionado'] = true;
        } else {
            $_SESSION['autorAdicionado'] = false;
        }

    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro no banco: " . $e->getMessage();
    }

    header('Location: ../paginas_tcc/pgManterAutor.php');
    exit;
}

if (isset($_POST['btnAlterar'])) {

    $sql = "UPDATE Autor SET 
                autor_nome = :nome_autor,
                autor_data_nascimento = :autor_data_nascimento,
                autor_data_falecimento = :autor_data_falecimento,
                autor_movimento_literario = :autor_movimento_literario,
                autor_biografia = :autor_biografia,
                autor_link_foto = :autor_link_foto
            WHERE autor_cod = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome_autor', $nome_autor);

    if ($data_nascimento_autor === null) {
        $stmt->bindValue(':autor_data_nascimento', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindValue(':autor_data_nascimento', $data_nascimento_autor);
    }

    if ($data_falecimento_autor === null) {
        $stmt->bindValue(':autor_data_falecimento', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindValue(':autor_data_falecimento', $data_falecimento_autor);
    }

    $stmt->bindParam(':autor_movimento_literario', $movimento_literario);
    $stmt->bindParam(':autor_biografia', $biografia_autor);
    $stmt->bindParam(':autor_link_foto', $foto_autor);

    if ($stmt->execute()) {
        $_SESSION['autorAlterado'] = true;
    } else {
        $_SESSION['autorAlterado'] = false;
    }

    header('Location: ../paginas_tcc/pgManterAutor.php');
    exit;
}

if (isset($_POST['btnDesativar'])) {

    $sql = "UPDATE autor SET autor_ativo = 0 WHERE autor_cod = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $_SESSION['autorDesativado'] = true;
    } else {
        $_SESSION['autorDesativado'] = false;
    }

    header('Location: ../paginas_tcc/pgManterAutor.php');
    exit;
}

?>
