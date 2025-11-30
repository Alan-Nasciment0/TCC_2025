<?php if (count($autores) > 0): ?>
<?php foreach ($autores as $autor): ?>
<div class="autor">
    <img class="autoresIMG" src="<?= htmlspecialchars($autor['autor_link_foto']) ?>" alt="autor">
    <h6 class="nomeAutores">
        <?= htmlspecialchars($autor['autor_nome']) ?>
    </h6>
    <form name="form_pgAutor" action="pgAutor.php" method="get">
        <input type="hidden" name="autor_cod" value="<?= htmlspecialchars($autor['autor_cod']) ?>">
        <input type="submit" class="botaoAutorSelecionado" name="autor_selecionado" value="">
    </form>
</div>
<?php endforeach; ?>
<?php endif; ?>