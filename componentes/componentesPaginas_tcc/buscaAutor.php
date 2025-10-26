<?php if (count($autores) > 0): ?>
<?php foreach ($autores as $autor): ?>
<div class="autor">
    <img class="autoresIMG" src="<?= htmlspecialchars($autor['autor_link_foto']) ?>" alt="autor">
    <h6>
        <?= htmlspecialchars($autor['autor_nome']) ?>
    </h6>
</div>
<?php endforeach; ?>
<?php endif; ?>