<?php if (count($livros_ranking) > 0): ?>
<?php $rank = 1;?>
<?php foreach ($livros_ranking as $livro_ranking): ?>

<div class="cartao">
    <div class="capa">
        <img src="<?= htmlspecialchars($livro_ranking['livro_capa_link']) ?>" class="imagem-capa">
    </div>
    <div class="informacoes">
        <div class="titulo"><?= $rank ?>. <?= htmlspecialchars($livro_ranking['livro_titulo']) ?></div>
        <div class="autor"><?= htmlspecialchars($livro_ranking['autor_nome']) ?></div>
        <div class="avaliacao">⭐ <?= htmlspecialchars($livro_ranking['media_notas']) ?> (<?= htmlspecialchars($livro_ranking['total_avaliacoes']) ?> avaliações)</div>
    </div>
    <form name="form_pgLivro" action="pgLivro.php" method="get">
        <input type="hidden" name="livro_cod" value="<?= htmlspecialchars($livro_ranking['livro_cod']) ?>">
        <input type="submit" class="botaoLivroSelecionado" name="livro_selecionado" value="">
    </form>
</div>
<?php $rank++; ?>
<?php endforeach; ?>
<?php endif; ?>