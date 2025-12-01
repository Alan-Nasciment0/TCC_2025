<?php
include('../BuscaBanidos/buscaBanidos.php');
?>

<?php if (count($banidos) > 0): ?>
<?php foreach ($banidos as $banido): ?>
<div class="containerCampo">
    <div>
        <h5 class="nome_usu">@
            <?= htmlspecialchars($banido['usuario_nome']) ?>
        </h5>
    </div>
    <div style="padding-left: 3rem;">
        <h5 class="tem_bam">
            <?=date('d/m/Y', strtotime($banido['data_expiracao']))?>
        </h5>
    </div>
    <div>
        <button class="btn btn-danger desbanirBtn" data-banido_cod="<?= $banido['usuario_cod'] ?>">
            Desbanir
        </button>
    </div>
</div>
<?php endforeach; ?>

<?php endif; ?>