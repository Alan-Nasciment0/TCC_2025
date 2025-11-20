<?php

include('../BuscaLivros/buscaLivros.php');
include('../BuscaMediaAvaliacao/buscaMediaAvaliacao.php');

$livro_cod = $_GET['livro_cod'] ?? null;
$sql = "SELECT 
    l.livro_cod,
    l.livro_titulo,
    l.livro_capa_link,
    l.livro_editora,
    l.livro_ano,
    l.livro_descricao,
    GROUP_CONCAT(DISTINCT a.autor_nome ORDER BY a.autor_nome SEPARATOR ', ') AS autor,
    GROUP_CONCAT(DISTINCT g.genero_nome ORDER BY g.genero_nome SEPARATOR ', ') AS genero,
    GROUP_CONCAT(DISTINCT c.categoria_nome ORDER BY c.categoria_nome SEPARATOR ', ') AS categoria
FROM livros l
LEFT JOIN autorLivro al ON l.livro_cod = al.livro_cod
LEFT JOIN autor a ON al.autor_cod = a.autor_cod
LEFT JOIN livroGenero lg ON l.livro_cod = lg.livro_cod
LEFT JOIN genero g ON lg.genero_cod = g.genero_cod
LEFT JOIN categoria c ON g.categoria_cod = c.categoria_cod
WHERE l.livro_cod = :livro_cod
GROUP BY l.livro_cod";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':livro_cod', $livro_cod);
$stmt->execute();
$livro = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Livro</title>
    <link rel="stylesheet" href="../css_js/css/styleLivro.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleContainerLivros.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body
    style="width: 100%;height: auto; display: flex; flex-direction: column; align-items: center; background-color: #1E1E1E;">

    <header>
        <?php
        include('../componentes/componentesIndex/pgCabecalhoIndex.php');
        
        ?>
    </header>
    <div class="container">
        <div class="containerLivroCapa">
            <img class="imgLivroCapa" src="<?php echo $livro['livro_capa_link'] ?>">
            <div>
                <div class="containerInformacoesLivro">
                    <div class="containerAlinhamentoLadoEsquerdo">
                        <div>
                            <h4>Avaliação do Livro</h4>
                            <div style="display: flex; align-items: center; height: 3.25rem;">
                                <img src="../img/star.png" class="imgAvaliacao">
                                <div style="margin-left: 1.5rem; height: 3.25rem;">
                                    <div style="display: flex; height: 1.75rem;">
                                        <p><?php echo number_format($mediaAvaliacao['media'], 1); ?></p>
                                        <p style="opacity: 20%;">/5</p>
                                    </div>
                                    <p style="height: 1.75rem;"><?php echo htmlspecialchars($mediaAvaliacao['total_avaliacoes']); ?> avaliações</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4>Autor</h4>
                            <p>
                                <?php echo $livro['autor']; ?>
                            </p>
                        </div>
                        <div>
                            <h4>Ano de Publicação</h4>
                            <p>
                                <?php echo $livro['livro_ano']; ?>
                            </p>
                        </div>
                    </div>

                    <div class="containerAlinhamentoLadoDireito">
                        <div class="subContainerAlinhamento">
                            <form id="form-avaliacao" style="margin-top: 1.37rem;">
                                <div style="display: flex; gap: 8px;">
                                    <input type="hidden" id="livro_cod"
                                        value="<?php echo htmlspecialchars($livro_cod); ?>">
                                    <img src="../img/starAvaliacao.png" class="estrela" name="btn-avaliacao"
                                        data-nota="<?php echo $i; ?>"
                                        style="width: 32px; height: 32px; cursor: pointer;">
                                    <img src="../img/starAvaliacao.png" class="estrela" name="btn-avaliacao"
                                        data-nota="<?php echo $i; ?>"
                                        style="width: 32px; height: 32px; cursor: pointer;">
                                    <img src="../img/starAvaliacao.png" class="estrela" name="btn-avaliacao"
                                        data-nota="<?php echo $i; ?>"
                                        style="width: 32px; height: 32px; cursor: pointer;">
                                    <img src="../img/starAvaliacao.png" class="estrela" name="btn-avaliacao"
                                        data-nota="<?php echo $i; ?>"
                                        style="width: 32px; height: 32px; cursor: pointer;">
                                    <img src="../img/starAvaliacao.png" class="estrela" name="btn-avaliacao"
                                        data-nota="<?php echo $i; ?>"
                                        style="width: 32px; height: 32px; cursor: pointer;">
                                </div>

                            </form>
                        </div>
                        <script>
                            document.querySelectorAll('.estrela').forEach(estrela => {
                                estrela.addEventListener('click', () => {
                                    alert("⚠️ Você precisa estar logado para avaliar o livro.");
                                });
                            });
                        </script>

                        <div>
                            <h4>Gênero da Obra</h4>
                            <p>
                                <?php echo $livro['genero']; ?>
                            </p>
                        </div>
                        <div>
                            <h4>Editora</h4>
                            <p>
                                <?php echo $livro['livro_editora']; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="containerDescricao">
                    <h4>Descrição</h4>
                    <p>
                        <?php echo $livro['livro_descricao']; ?>
                    </p>

                    <button id="btn-favoritos" class="btn btn-warning" style="width: 16.31rem; height: 3.28rem;">
                        <img src="../img/coracao.png" style="width: 24px; height: 24px; margin-right: 0.5rem;">
                        Adicionar aos favoritos
                    </button>

                    <button id="btn-lido" class="btn btn-info"
                        style="width: 16.31rem; height: 3.28rem; margin-left: 89px;">
                        <img src="../img/img.visto.png" style="width: 24px; height: 24px; margin-right: 0.5rem;">
                        Marcar livro como já lido
                    </button>
                </div>
            </div>
        </div>

        <script> document.getElementById('btn-favoritos').addEventListener('click', function () { alert("⚠️ Você precisa estar logado para adicionar o livro como favorito."); return; }); </script>
        <script> document.getElementById('btn-lido').addEventListener('click', function () { alert("⚠️ Você precisa estar logado para adicionar o livro como lido."); return; }); </script>

        <div class="containerLivrosRecomendados">
            <h4>Livros Recomendados</h4>
            <div class="containerLivroRecomendado">
                <?php
                include('../componentes/componentesPaginas_tcc/livrosRecomendados.php');
                ?>
            </div>
        </div>

    </div>

    <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
    ?>
    
    <script>
    document.querySelectorAll('.marcador').forEach(btn => {
        btn.addEventListener('click', function () {
            alert("Você precisa estar logado para adicionar aos favoritos.");
            return;
        });
    });
    </script>

</body>

</html>