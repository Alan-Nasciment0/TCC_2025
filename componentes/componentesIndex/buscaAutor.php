<?php if (count($autores) > 0): ?>
<?php foreach ($autores as $autor): ?>
<div class="autor">
    <img class="autoresIMG" src="<?= htmlspecialchars($autor['autor_link_foto']) ?>" alt="autor">
    <h6 class="nomeAutores">
        <?= htmlspecialchars($autor['autor_nome']) ?>
    </h6>
    <form name="form_pgAutor" action="pgAutor.php" method="post">
        <input type="hidden" name="cod_autor_selecionado" value="<?= htmlspecialchars($autor['autor_cod']) ?>">
        <input type="hidden" name="nome_autor_selecionado" value="<?= htmlspecialchars($autor['autor_nome']) ?>">
        <input type="hidden" name="autor_data_nascimento_selecionado" value="<?= htmlspecialchars($autor['autor_data_nascimento']) ?>">
        <input type="hidden" name="autor_data_falecimento_selecionado" value="<?= htmlspecialchars($autor['autor_data_falecimento']) ?>">
        <input type="hidden" name="autor_movimento_literario_selecionado" value="<?= htmlspecialchars($autor['autor_movimento_literario']) ?>">
        <input type="hidden" name="autor_biografia_selecionado" value="<?= htmlspecialchars($autor['autor_biografia']) ?>">
        <input type="hidden" name="autor_link_foto_selecionado" value="<?= htmlspecialchars($autor['autor_link_foto']) ?>">
        <input type="submit" class="botaoAutorSelecionado" name="autor_selecionado" value="">
    </form>
</div>
<?php endforeach; ?>
<?php endif; ?>