<?php
include('../BuscaLivros/buscaLivrosFavoritos.php');
?>

<?php if (count($favoritos) > 0): ?>
<?php foreach ($favoritos as $livro_favorito): ?>

<div class="livro">
    <img src="<?= htmlspecialchars($livro_favorito['livro_capa_link']) ?>" class="imgLivro">
    <div class="gradiente"></div>
    <a class="marcador"><img src="../img/salvar_livro.png" class="imgMarcador"></a>
    <h6 class="nomeLivro">
        <?= htmlspecialchars($livro_favorito['livro_titulo']) ?>
    </h6>
    <h6 class="nomeAutor">
        <?= htmlspecialchars($livro_favorito['autor_nome']) ?>
    </h6>
    <div class="avaliacoes">
        <img src="../img/star.png" class="imgEstrela">
        <h6 class="mediaAvaliacao">4,1</h6>
    </div>
    <form name="form_pgLivro" action="pgLivro.php" method="post">
        <input type="hidden" name="cod_livro_selecionado" value="<?= htmlspecialchars($livro_favorito['livro_cod']) ?>">
        <input type="hidden" name="livro_titulo_selecionado"
            value="<?= htmlspecialchars($livro_favorito['livro_titulo']) ?>">
        <input type="hidden" name="livro_capa_selecionado"
            value="<?= htmlspecialchars($livro_favorito['livro_capa_link']) ?>">
        <input type="hidden" name="livro_editora_selecionado"
            value="<?= htmlspecialchars($livro_favorito['livro_editora']) ?>">
        <input type="hidden" name="livro_descricao_selecionado"
            value="<?= htmlspecialchars($livro_favorito['livro_descricao']) ?>">
        <input type="hidden" name="autor_nome_selecionado" value="<?= htmlspecialchars($livro_favorito['autor_nome']) ?>">
        <input type="hidden" name="genero_nome_selecionado" value="<?= htmlspecialchars($livro_favorito['genero_nome']) ?>">
        <input type="hidden" name="livro_ano_selecionado" value="<?= htmlspecialchars($livro_favorito['livro_ano']) ?>">
        <input type="submit" class="botaoLivroSelecionado" name="livro_selecionado" value="">
    </form>
</div>

<?php endforeach; ?>
<?php else: ?>
<p style="text-align:center; opacity:0.7;">Nenhum livro foi adicionado aos favoritos ainda.</p>
<?php endif; ?>
</div>