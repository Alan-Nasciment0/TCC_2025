<?php
include('../BuscaDenuncia/buscaDenuncia.php');
?>

<?php if (count($denuncias) > 0): ?>
<?php foreach ($denuncias as $denuncia): ?>
<div class="containerCampo">
    <div class="containerTexto">
        <h5 class="textoDenuncia">@
            <?= htmlspecialchars($denuncia['usuario_nome']) ?>
        </h5>
    </div>

    <div class="containerTexto">
        <h5 class="textoDenuncia">
            <?= htmlspecialchars($denuncia['comentario_texto']) ?>
        </h5>
    </div>

    <div class="containerTexto">
        <h5 class="textoDenuncia">
            <?= htmlspecialchars($denuncia['motivo']) ?>
        </h5>
    </div>

    <div class="containerTexto">
        <img src="../img/acoes.png" class="imgAcoes" alt="Ações"
            data-nome="<?= htmlspecialchars($denuncia['usuario_nome']) ?>"
            data-usuario_cod="<?= htmlspecialchars($denuncia['usuario_cod']) ?>"
            data-foto="../img/foto_perfil_usuario/<?= htmlspecialchars($denuncia['foto_perfil_usuario'] ?: '../img/default.png') ?>"
            data-qtd="<?= htmlspecialchars($denuncia['quantidade_denuncias']) ?>"
            data-livro="<?= htmlspecialchars($denuncia['livro_nome']) ?>"
            data-comentario="<?= htmlspecialchars($denuncia['comentario_texto']) ?>">
    </div>
</div>
<?php endforeach; ?>

<?php endif; ?>