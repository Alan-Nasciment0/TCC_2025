<?php if (count($livros) > 0): ?>
            <?php foreach ($livros as $livro): ?>
            <div class="livro">
                <img src="<?= htmlspecialchars($livro['livro_capa_link']) ?>" class="imgLivro">
                <div class="gradiente"></div>
                <a class="marcador"><img src="../img/bookmark.png" class="imgMarcador"></a>
                <h6 class="nomeLivro">
                    <?= htmlspecialchars($livro['livro_titulo']) ?>
                </h6>
                <h6 class="nomeAutor">Machado de Assis</h6>
                <div class="avaliacoes">
                    <img src="../img/star.png" class="imgEstrela">
                    <h6 class="mediaAvaliacao">4,1</h6>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>