<?php
include('../BuscaLivros/buscaLivrosRecomendados.php');
?>

<?php if (count($livros_recomendados) > 0): ?>
<?php foreach ($livros_recomendados as $livro_recomendados): ?>

<div class="livro">
    <img src="<?= htmlspecialchars($livro_recomendados['livro_capa_link']) ?>" class="imgLivro">
    <div class="gradiente"></div>
    <a class="marcador"><img src="../img/salvar_livro.png" class="imgMarcador"></a>
    <h6 class="nomeLivro">
        <?= htmlspecialchars($livro_recomendados['livro_titulo']) ?>
    </h6>
    <h6 class="nomeAutor">
        <?= htmlspecialchars($livro_recomendados['autor_nome']) ?>
    </h6>
    <?php
    $sql = "SELECT AVG(nota) AS media, COUNT(*) AS total_avaliacoes FROM Avaliacoes WHERE livro_cod = :livro_cod";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':livro_cod', $livro_recomendados['livro_cod'], PDO::PARAM_INT);
    $stmt->execute();
    $mediaAvaliacao = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="avaliacoes">
        <img src="../img/star.png" class="imgEstrela">
        <h6 class="mediaAvaliacao"><?php echo number_format($mediaAvaliacao['media'], 1); ?></h6>
    </div>
    <form name="form_pgLivro" action="pgLivro.php" method="get">
        <input type="hidden" name="livro_cod" value="<?= htmlspecialchars($livro_recomendados['livro_cod']) ?>">        
        <input type="submit" class="botaoLivroSelecionado" name="livro_selecionado" value="">
    </form>
</div>

<?php endforeach; ?>
<?php endif; ?>