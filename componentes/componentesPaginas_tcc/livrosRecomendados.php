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
    <div class="avaliacoes">
        <img src="../img/star.png" class="imgEstrela">
        <h6 class="mediaAvaliacao">4,1</h6>
    </div>
    <form name="form_pgLivro" action="pgLivro.php" method="get">
        <input type="hidden" name="livro_cod" value="<?= htmlspecialchars($livro_recomendados['livro_cod']) ?>">        
        <input type="submit" class="botaoLivroSelecionado" name="livro_selecionado" value="">
    </form>
</div>

<?php endforeach; ?>
<?php endif; ?>