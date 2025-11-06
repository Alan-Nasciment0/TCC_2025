<?php
session_start();
require '../conexao_bd_sql/conexao_bd_mysql.php'; // $pdo é criado aqui

if (isset($_POST['salvar_categoria'])) {
    $usuarioCod = $_SESSION['usuario_cod'];
    $categorias = $_POST['categoriaPreferencia'] ?? [];

    if (empty($categorias)) {
        $_SESSION['mensagem'] = "Selecione ao menos uma categoria.";
        header('Location: ../paginas_tcc/pgcategoria.php');
        exit;
    }

    try {
        $sql = "INSERT INTO categoria_preferida_usuario (usuario_cod, categoria_cod) VALUES (:usuario_cod, :categoria_cod)";
        $stmt = $pdo->prepare($sql);

        foreach ($categorias as $categoria) {
            $stmt->execute([
                ':usuario_cod' => $usuarioCod,
                ':categoria_cod' => $categoria
            ]);
        }

        // Transformar as categorias em string para enviar via GET
        $categorias_str = implode(',', $categorias);
        header("Location: ../paginas_tcc/pggenero.php?categorias=$categorias_str");
        exit;

    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro no banco: " . $e->getMessage();
        header('Location: ../paginas_tcc/pgcategoria.php');
        exit;
    }
}


if (isset($_POST['salvar_genero'])) {
    $usuarioCod = $_SESSION['usuario_cod'];
    $generos = $_POST['generoPreferencia'] ?? [];

    if (empty($generos)) {
        $_SESSION['mensagem'] = "Selecione ao menos um gênero.";
        header('Location: ../paginas_tcc/pggenero.php');
        exit;
    }

    try {
        $sql = "INSERT INTO genero_preferido_usuario (usuario_cod, genero_cod) VALUES (:usuario_cod, :genero_cod)";
        $stmt = $pdo->prepare($sql);

        foreach ($generos as $genero) {
            $stmt->execute([
                ':usuario_cod' => $usuarioCod,
                ':genero_cod' => $genero
            ]);
        }

        $_SESSION['mensagem'] = "Preferências salvas com sucesso!";
        header('Location: ../paginas_tcc/pgHome.php');
        exit;

    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro ao salvar gênero: " . $e->getMessage();
        header('Location: ../paginas_tcc/pggenero.php');
        exit;
    }
}
?>