<?php

include('../BuscaLivros/buscaLivros.php');
$autor_cod = isset($_GET['autor_cod']) ? (int) $_GET['autor_cod'] : null;

// variáveis padrão (evita warnings)
$autor_nome = "Autor não encontrado";
$autor_data_nascimento = "";
$autor_data_falecimento = "";
$autor_movimento_literario = "";
$autor_biografia = "";
$autor_link_foto = "../img/userPadrao.png";

if ($autor_cod) {
    $sql = "SELECT autor_cod, autor_nome, autor_data_nascimento, autor_data_falecimento, autor_movimento_literario, autor_biografia, autor_link_foto
            FROM autor
            WHERE autor_cod = :autor_cod
            LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':autor_cod', $autor_cod, PDO::PARAM_INT);
    $stmt->execute();
    $autor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($autor) {
        // Preenche variáveis com os dados reais (usando coalesce simples)
        $autor_nome = $autor['autor_nome'] ?? $autor_nome;
        $autor_data_nascimento = $autor['autor_data_nascimento'] ?? "";
        $autor_data_falecimento = $autor['autor_data_falecimento'] ?? "";
        $autor_movimento_literario = $autor['autor_movimento_literario'] ?? "";
        $autor_biografia = $autor['autor_biografia'] ?? "";
        $autor_link_foto = $autor['autor_link_foto'] ?? $autor_link_foto;
    } else {
        // Se quiser redirecionar para uma página de erro:
        // header('Location: listaAutores.php'); exit;
        // Ou apenas mantém as mensagens "não encontrado"
    }
} else {
    // autor_cod não foi enviado — você pode redirecionar ou mostrar mensagem
    // header('Location: listaAutores.php'); exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Autor - <?= htmlspecialchars($autor_nome) ?></title>
    <link rel="stylesheet" href="../css_js/css/styleAutor.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <link rel="stylesheet" href="../css_js/css/styleContainerLivros.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body style="width: 100%;height: auto; display: flex; flex-direction: column; align-items: center; background-color: #1E1E1E;">

    <header>
        <?php
        include('../componentes/componentesIndex/pgCabecalhoIndex.php');
        
        ?>
    </header>

    <div class="container">
        <div class="containerAutor">
            <img class="imgAutor" src="<?= htmlspecialchars($autor_link_foto) ?>" alt="Foto do autor">

            <div class="containerInformacoesAutor">
                <div class="containerNome">
                    <h4>Autor</h4>
                    <p><?= htmlspecialchars($autor_nome) ?></p>
                </div>

                <div class="containerAlinhamento">

                    <div class="containerMovimentoLiterário">
                        <h4>Movimento Literário</h4>
                        <p><?= htmlspecialchars($autor_movimento_literario) ?></p>
                    </div>
                    <div class="containerNascimento">
                        <h4>Nascimento</h4>
                        <p><?= htmlspecialchars($autor_data_nascimento) ?></p>
                    </div>
                    <div class="containerFalecimento">
                        <h4>Falecimento</h4>
                        <p><?= htmlspecialchars($autor_data_falecimento) ?></p>
                    </div>

                </div>

                <div class="containerBiografia">

                    <h4>Biografia</h4>
                    <p><?= nl2br(htmlspecialchars($autor_biografia)) ?></p>

                </div>

            </div>
        </div>

        <div class="containerPrincipaisObrasAutor">
            <h4>Principais Obras</h4>
            <div class="containerPrincipalObra">
                <?php
             include('../componentes/componentesIndex/livrosRecomendados.php');
            ?>
            </div>
        </div> 
    </div>
    <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
        ?>
</body>

</html>