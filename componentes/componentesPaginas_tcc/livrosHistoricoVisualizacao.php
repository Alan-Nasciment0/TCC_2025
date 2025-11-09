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
            <h2 class='titulo'><?= $dia ?></h2>
        </div>
        <div class='alinhamentoDataHora'>
            <?php foreach ($livrosDoDia as $livro_visualizado): ?>
                <div class="livro">
                    <img src="<?= htmlspecialchars($livro_visualizado['livro_capa_link']) ?>" class="imgLivro">
                    <div class="gradiente"></div>
                    <a class="marcador"><img src="../img/salvar_livro.png" class="imgMarcador"></a>
                    <h6 class="nomeLivro"><?= htmlspecialchars($livro_visualizado['livro_titulo']) ?></h6>
                    <h6 class="nomeAutor"><?= htmlspecialchars($livro_visualizado['autor_nome']) ?></h6>
                    <div class="avaliacoes">
                        <img src="../img/star.png" class="imgEstrela">
                        <h6 class="mediaAvaliacao">4,1</h6>
                    </div>
                    <form name="form_pgLivro" action="pgLivro.php" method="post">
                        <input type="hidden" name="cod_livro_selecionado" value="<?= htmlspecialchars($livro_visualizado['livro_cod']) ?>">
                        <input type="hidden" name="livro_titulo_selecionado" value="<?= htmlspecialchars($livro_visualizado['livro_titulo']) ?>">
                        <input type="hidden" name="livro_capa_selecionado" value="<?= htmlspecialchars($livro_visualizado['livro_capa_link']) ?>">
                        <input type="hidden" name="livro_editora_selecionado" value="<?= htmlspecialchars($livro_visualizado['livro_editora']) ?>">
                        <input type="hidden" name="livro_descricao_selecionado" value="<?= htmlspecialchars($livro_visualizado['livro_descricao']) ?>">
                        <input type="hidden" name="autor_nome_selecionado" value="<?= htmlspecialchars($livro_visualizado['autor_nome']) ?>">
                        <input type="hidden" name="genero_nome_selecionado" value="<?= htmlspecialchars($livro_visualizado['genero_nome']) ?>">
                        <input type="hidden" name="livro_ano_selecionado" value="<?= htmlspecialchars($livro_visualizado['livro_ano']) ?>">
                        <input type="submit" class="botaoLivroSelecionado" name="livro_selecionado" value="">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
