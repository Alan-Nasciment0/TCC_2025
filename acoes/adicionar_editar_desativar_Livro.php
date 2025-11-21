<?php
session_start();
include('../conexao_bd_sql/conexao_bd_mysql.php');

$livro_cod = ($_POST['livro_cod']);
$livro_capa_link =  $_POST['livro_capa_link']; 
$autor_nome =  $_POST['autor_nome'];
$autor_cod =  $_POST['autor_cod'];
$livro_titulo =  $_POST['livro_titulo'];
$livro_genero = $_POST['livro_genero'];
$genero_cod = $_POST['genero_cod'];
$livro_categoria = $_POST['livro_categoria'];
$livro_ano =  $_POST['livro_ano'];
$livro_editora =  $_POST['livro_editora'];
$livro_descricao =  $_POST['livro_descricao'];


if (isset($_POST['adicionarLivro'])) {

    try {
        
        $pdo->beginTransaction();
        
        $sqlLivro = "INSERT INTO livros (livro_titulo, livro_ano, livro_editora, livro_descricao, livro_capa_link)
                     VALUES (:livro_titulo, :livro_ano, :livro_editora, :livro_descricao, :livro_capa_link)";
        $stmtLivro = $pdo->prepare($sqlLivro);
        $stmtLivro->execute([
            ':livro_titulo' => $livro_titulo,
            ':livro_ano' => $livro_ano,
            ':livro_editora' => $livro_editora,
            ':livro_descricao' => $livro_descricao,
            ':livro_capa_link' => $livro_capa_link
        ]);

        $livro_cod = $pdo->lastInsertId();

       
        $sqlAutorLivro = "INSERT INTO autorlivro (livro_cod, autor_cod) VALUES (:livro_cod, :autor_cod)";
        $stmtAutorLivro = $pdo->prepare($sqlAutorLivro);
        if ($autor_cod) {
        $stmtAutorLivro->execute([
            ':livro_cod' => $livro_cod,
            ':autor_cod' => $autor_cod
        ]);
        }

        

        $sqlGeneroLivro = "INSERT INTO livroGenero (livro_cod, genero_cod) VALUES (:livro_cod, :genero_cod)";
        $stmtGeneroLivro = $pdo->prepare($sqlGeneroLivro);
        if ($genero_cod) {
        $stmtGeneroLivro->execute([
            ':livro_cod' => $livro_cod,
            ':genero_cod' => $genero_cod
        ]);
        }       

        $pdo->commit();
        $_SESSION['livroAdicionado'] = true;

    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION['livroAdicionado'] = false;
        $_SESSION['mensagem'] = "Erro no banco: " . $e->getMessage();
    }

    header('Location: ../paginas_tcc/pgManterLivro.php');
    exit;
}



if (isset($_POST['btnAlterar'])) {
    $livro_cod = $_POST['livro_cod'];
    $camposLivro = [];
    $parametrosLivro = [':livro_cod' => $livro_cod];

    // Campos do livro
    if (!empty($_POST['livro_titulo'])) {
        $camposLivro[] = 'livro_titulo = :livro_titulo';
        $parametrosLivro[':livro_titulo'] = $_POST['livro_titulo'];
    }
    if (!empty($_POST['livro_ano'])) {
        $camposLivro[] = 'livro_ano = :livro_ano';
        $parametrosLivro[':livro_ano'] = $_POST['livro_ano'];
    }
    if (!empty($_POST['livro_editora'])) {
        $camposLivro[] = 'livro_editora = :livro_editora';
        $parametrosLivro[':livro_editora'] = $_POST['livro_editora'];
    }
    if (!empty($_POST['livro_descricao'])) {
        $camposLivro[] = 'livro_descricao = :livro_descricao';
        $parametrosLivro[':livro_descricao'] = $_POST['livro_descricao'];
    }
    if (!empty($_POST['livro_capa_link'])) {
        $camposLivro[] = 'livro_capa_link = :livro_capa_link';
        $parametrosLivro[':livro_capa_link'] = $_POST['livro_capa_link'];
    }

    try {
        $pdo->beginTransaction();

        // Atualiza livro se houver campos
        if (!empty($camposLivro)) {
            $sqlLivroUpdate = "UPDATE livros SET " . implode(', ', $camposLivro) . " WHERE livro_cod = :livro_cod";
            $stmtLivroUpdate = $pdo->prepare($sqlLivroUpdate);
            $stmtLivroUpdate->execute($parametrosLivro);
        }

        // Atualiza autor se enviado
        if (!empty($_POST['autor_cod'])) {
            $sqlAutorUpdate = "UPDATE autorlivro SET autor_cod = :autor_cod WHERE livro_cod = :livro_cod";
            $stmtAutorUpdate = $pdo->prepare($sqlAutorUpdate);
            $stmtAutorUpdate->execute([
                ':autor_cod' => $_POST['autor_cod'],
                ':livro_cod' => $livro_cod
            ]);
        }

        // Atualiza gênero se enviado
        if (!empty($_POST['genero_cod'])) {
            $sqlGeneroUpdate = "UPDATE livroGenero SET genero_cod = :genero_cod WHERE livro_cod = :livro_cod";
            $stmtGeneroUpdate = $pdo->prepare($sqlGeneroUpdate);
            $stmtGeneroUpdate->execute([
                ':genero_cod' => $_POST['genero_cod'],
                ':livro_cod' => $livro_cod
            ]);
        }

        $pdo->commit();
        $_SESSION['livroAlterado'] = true;

    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION['livroAlterado'] = false;
        $_SESSION['mensagem'] = "Erro no banco: " . $e->getMessage();
    }

    header('Location: ../paginas_tcc/pgManterLivro.php');
    exit;
}

if (isset($_POST['btnDesativar'])) {

    $sql = "UPDATE livros SET livro_ativo = 0 WHERE livro_cod = :livro_cod";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':livro_cod', $livro_cod);

    if ($stmt->execute()) {
        $_SESSION['livroDesativado'] = true;
    } else {
        $_SESSION['livroDesativado'] = false;
    }

    header('Location: ../paginas_tcc/pgManterLivro.php');
    exit;
}

?>
