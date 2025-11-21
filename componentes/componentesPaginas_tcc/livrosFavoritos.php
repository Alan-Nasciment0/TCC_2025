<?php
include('../BuscaLivros/buscaLivrosFavoritos.php');
?>

<?php if (count($favoritos) > 0): ?>
<?php foreach ($favoritos as $livro_favorito): ?>
    <?php
        // Verifica se o livro já está nos favoritos
        $sql = "SELECT 1 FROM Favoritos WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_cod' => $usuario_cod,
            ':livro_cod' => $livro_favorito['livro_cod']
        ]);
        $favorito = $stmt->fetchColumn() ? true : false;
        ?>
<div class="livro">
    <img src="<?= htmlspecialchars($livro_favorito['livro_capa_link']) ?>" class="imgLivro">
    <div class="gradiente"></div>
    <button class="marcador" data-livro-cod="<?= $livro_favorito['livro_cod'] ?>">
        <img src="<?= $favorito ? '../img/bookmark_preenchido.png' : '../img/salvar_livro.png' ?>" class="imgMarcador">
    </button>
    <h6 class="nomeLivro">
        <?= htmlspecialchars($livro_favorito['livro_titulo']) ?>
    </h6>
    <h6 class="nomeAutor">
        <?= htmlspecialchars($livro_favorito['autor_nome']) ?>
    </h6>
    <?php
    $sql = "SELECT AVG(nota) AS media, COUNT(*) AS total_avaliacoes FROM Avaliacoes WHERE livro_cod = :livro_cod";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':livro_cod', $livro_favorito['livro_cod'], PDO::PARAM_INT);
    $stmt->execute();
    $mediaAvaliacao = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="avaliacoes">
        <img src="../img/star.png" class="imgEstrela">
        <h6 class="mediaAvaliacao"><?php echo number_format($mediaAvaliacao['media'], 1); ?></h6>
    </div>
    <form name="form_pgLivro" action="pgLivro.php" method="get">
        <input type="hidden" name="livro_cod" value="<?= htmlspecialchars($livro_favorito['livro_cod']) ?>">        
        <input type="submit" class="botaoLivroSelecionado" name="livro_selecionado" value="">
    </form>
</div>

<?php endforeach; ?>
<?php else: ?>
<p style="text-align:center; opacity:0.7;">Nenhum livro foi adicionado aos favoritos ainda.</p>
<?php endif; ?>
</div>

