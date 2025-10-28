<?php if (count($informacoes_livros) > 0): ?>
            <?php foreach ($informacoes_livros as $info_livro): ?>
            <div class="livro">
                <img src="<?= htmlspecialchars($info_livro['livro_capa_link']) ?>" class="imgLivro">
                <div class="gradiente"></div>
                <a class="marcador"><img src="img/salvar_livro.png" class="imgMarcador"></a>
                <h6 class="nomeLivro">
                    <?= htmlspecialchars($info_livro['livro_titulo']) ?>
                </h6>
                <h6 class="nomeAutor"><?= htmlspecialchars($info_livro['autor_nome']) ?></h6>
                <div class="avaliacoes">
                    <img src="img/star.png" class="imgEstrela">
                    <h6 class="mediaAvaliacao">4,1</h6>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>