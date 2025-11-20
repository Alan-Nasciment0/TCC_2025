<?php
include('../buscaComentario/buscaComentario.php');
?>

<?php if (count($comentarios) > 0){ ?>
<?php foreach ($comentarios as $comentario): ?>

<div class="containerComentarioFeito">
    <img class="fotoUsuario"
        src="../img/foto_perfil_usuario/<?= htmlspecialchars($comentario['foto_perfil_usuario']) ?>">
    <div class="containerComentarioTexto">
        <div>
            <h6 class="nomeUsuario">@
                <?= htmlspecialchars($comentario['usuario_nome']) ?>
            </h6>
            <div>
                <textarea class="txtComentario" id="txtComentario" name="txtComentario"
                    placeholder="Adicionar Comentario" disabled>
            <?= htmlspecialchars($comentario['comentario_texto']) ?>
        </textarea>
            </div>
        </div>
        <button class="botaoDenuncia">
            <img class="denuncia" src="../img/menuDenuncia.png">
        </button>
    </div>
</div>

<?php endforeach; ?>
<?php }else {?>
<p style="text-align:center; opacity:0.7;">Nenhum comentário ainda.</p>
<?php
} ?>