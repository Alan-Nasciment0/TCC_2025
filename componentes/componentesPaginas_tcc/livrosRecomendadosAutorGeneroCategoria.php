<?php
include('../BuscaLivros/buscaLivrosMesmoAutorGeneroCategoria.php');
?>

<?php if (count($livros_recomendadosAutorGeneroCategoria) > 0): ?>
<?php foreach ($livros_recomendadosAutorGeneroCategoria as $livro_recomendadosAutorGeneroCategoria): ?>

<div class="livro">
    <img src="<?= htmlspecialchars($livro_recomendadosAutorGeneroCategoria['livro_capa_link']) ?>" class="imgLivro">
    <div class="gradiente"></div>
    <button class="marcador" id="marcadorLivroRecomendadoAutor"><img src="../img/salvar_livro.png" class="imgMarcador"></button>
    <h6 class="nomeLivro">
        <?= htmlspecialchars($livro_recomendadosAutorGeneroCategoria['livro_titulo']) ?>
    </h6>
    <h6 class="nomeAutor">
        <?= htmlspecialchars($livro_recomendadosAutorGeneroCategoria['autor_nome']) ?>
    </h6>
    <?php
    $sql = "SELECT AVG(nota) AS media, COUNT(*) AS total_avaliacoes FROM Avaliacoes WHERE livro_cod = :livro_cod";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':livro_cod', $livro_recomendadosAutorGeneroCategoria['livro_cod'], PDO::PARAM_INT);
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
        <input type="hidden" name="livro_cod"
            value="<?= htmlspecialchars($livro_recomendadosAutorGeneroCategoria['livro_cod']) ?>">
        <input type="submit" class="botaoLivroSelecionado" name="livro_selecionado" value="">
    </form>
</div>

<?php 
    $usuario_cod = $_SESSION['usuario_cod'];                            
                    
    // Verifica se o livro já está nos favoritos
    $sql = "SELECT * FROM Favoritos WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_cod', $usuario_cod, PDO::PARAM_INT);
    $stmt->bindParam(':livro_cod', $livro['livro_cod'], PDO::PARAM_INT);
    $stmt->execute();
    $favorito = $stmt->fetch(PDO::FETCH_ASSOC);
                    
    // Se o livro já estiver nos favoritos, muda a cor e o texto do botão
    if ($favorito) {
        echo "
        <script>
            const btnFav = document.getElementById('marcadorLivroRecomendadoAutor');
            btnFav.classList.remove('btn-warning');
            btnFav.classList.add('btn-success');
            btnFav.innerHTML = '<img src=\"../img/bookmark_preenchido.png\">';
        </script>";
    }
    ?>

<script>
    document.getElementById('marcadorLivroRecomendadoAutor').addEventListener('click', function () {
        const livroCod = "<?php echo $livro['livro_cod']; ?>";
        const btnFav = document.getElementById('marcadorLivroRecomendadoAutor');

        fetch('../acoes/adicionarLivrosFavoritos.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'livro_cod=' + encodeURIComponent(livroCod)
        })
            .then(response => response.text())
            .then(data => {
                alert(data);

                if (data.includes("✅")) {
                    // Adicionado aos favoritos                   
                    btnFav.innerHTML = '<img src="../img/bookmark_preenchido.png\">';
                } else if (data.includes("❎")) {
                    // Removido dos favoritos                    
                    btnFav.innerHTML = '<img src="../img/salvar_livro.png\">';
                }
            })
            .catch(error => {
                alert("Erro ao adicionar livro aos favoritos.");
                console.error(error);
            });
    });
</script>

<?php endforeach; ?>
<?php endif; ?>