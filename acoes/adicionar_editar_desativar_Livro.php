<?php
session_start();
include('../conexao_bd_sql/conexao_bd_mysql.php');

$id = $_POST['livro_cod'];
$livro_capa_link =  $_POST['livro_capa_link']; 
$autor_nome =  $_POST['autor_nome'];
$livro_titulo =  $_POST['livro_titulo'];
$livro_genero = $_POST['livro_genero'];
$livro_categoria = $_POST['livro_categoria'];
$livro_ano =  $_POST['livro_ano'];
$livro_editora =  $_POST['livro_editora'];
$livro_descricao =  $_POST['livro_descricao'];


if (isset($_POST['adicionarLivro'])) {

    try {
        $pdo->beginTransaction();
        $sqlLivro = "INSERT INTO Livros (livro_titulo, livro_ano, livro_editora, livro_descricao, livro_capa_link) VALUES
        (:livro_titulo, :livro_ano, :livro_editora, :livro_descricao, :livro_capa_link)";

        $stmt = $pdo->prepare($sqlLivro);
        $stmt->bindParam(':livro_titulo', $livro_titulo);
        $stmt->bindParam(':livro_ano', $livro_ano);
        $stmt->bindParam(':livro_editora', $livro_editora);
        $stmt->bindParam(':livro_descricao', $livro_descricao);
        $stmt->bindParam(':livro_capa_link', $livro_capa_link);

        if ($stmt->execute()) {
            $_SESSION['livro'] = true;
        } else {
            $_SESSION['autorAdicionado'] = false;
        }
    
        $sqlAutorLivro = "INSERT INTO autorlivro (livro_cod, autor_cod) VALUES (:livro_cod, :autor_cod);"
        $stmt = $pdo->prepare($sqlLivro);
        $stmt->bindParam(':livro_cod', $livro_cod);
        $stmt->bindParam(':autor', $livro_ano);

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
