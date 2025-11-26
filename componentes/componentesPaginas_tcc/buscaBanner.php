<?php include('../buscaBanner/buscaBanner.php'); ?>

<?php if (!empty($banners_ativos)): ?>

    <?php foreach ($banners_ativos as $index => $banner): ?>
        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <a href="<?= htmlspecialchars($banner['link']) ?>" target="_blank">
                <img class="d-block w-100 bannerIMG" 
                     src="../img/banners/<?= htmlspecialchars($banner['banner_imagem']) ?>" 
                     alt="Banner">
            </a>
        </div>
    <?php endforeach; ?>

<?php endif; ?>
