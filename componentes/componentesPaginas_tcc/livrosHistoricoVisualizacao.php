<?php
include('../BuscaLivros/buscaLivrosHistorico.php');

$historicoPorDia = [];

// Agrupa os livros por dia
foreach ($historico_visualizacao_usuario as $livro) {
    $dia = $livro['dia_formatado']; // Ex: '09/11/2025'
    if (!isset($historicoPorDia[$dia])) {
        $historicoPorDia[$dia] = [];
    }
    $historicoPorDia[$dia][] = $livro;
}
?>

<?php if (!empty($historicoPorDia)): ?>
<?php foreach ($historicoPorDia as $dia => $livrosDoDia): ?>
<div class='containerHistoricoData'>
    <h2 class='titulo'>
        <?= $dia ?>
    </h2>
</div>
<div class='alinhamentoDataHora'>
    <?php foreach ($livrosDoDia as $livro_visualizado): ?>
        <?php
        // Verifica se o livro já está nos favoritos
        $sql = "SELECT 1 FROM Favoritos WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_cod' => $usuario_cod,
            ':livro_cod' => $livro_visualizado['livro_cod']
        ]);
        $favorito = $stmt->fetchColumn() ? true : false;
        ?>
    <div class="livro">
        <img src="<?= htmlspecialchars($livro_visualizado['livro_capa_link']) ?>" class="imgLivro">
        <div class="gradiente"></div>
        <button class="marcador" data-livro-cod="<?= $livro_visualizado['livro_cod'] ?>">
        <img src="<?= $favorito ? '../img/bookmark_preenchido.png' : '../img/salvar_livro.png' ?>" class="imgMarcador">
    </button>
        <h6 class="nomeLivro">
            <?= htmlspecialchars($livro_visualizado['livro_titulo']) ?>
        </h6>
        <h6 class="nomeAutor">
            <?= htmlspecialchars($livro_visualizado['autor_nome']) ?>
        </h6>
        <?php
        $sql = "SELECT AVG(nota) AS media, COUNT(*) AS total_avaliacoes FROM Avaliacoes WHERE livro_cod = :livro_cod";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':livro_cod', $livro_visualizado['livro_cod'], PDO::PARAM_INT);
        $stmt->execute();
        $mediaAvaliacao = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="avaliacoes">
            <img src="../img/star.png" class="imgEstrela">
            <h6 class="mediaAvaliacao">
                <?php echo number_format($mediaAvaliacao['media'], 1); ?>
            </h6>
        </div>
        <form name="form_pgLivro" action="pgLivro.php" method="get">
            <input type="hidden" name="livro_cod" value="<?= htmlspecialchars($livro_visualizado['livro_cod']) ?>">
            <input type="submit" class="botaoLivroSelecionado" name="livro_selecionado" value="">
        </form>
    </div>
    <?php endforeach; ?>
</div>
<?php endforeach; ?>
<?php endif; ?>

