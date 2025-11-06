<?php
session_start();

include('../BuscaLivros/buscaLivros.php');

$livro_cod =  $_POST['cod_livro_selecionado']; 
$livro_titulo =  $_POST['livro_titulo_selecionado'];
$livro_capa = $_POST['livro_capa_selecionado'];
$livro_editora = $_POST['livro_editora_selecionado'];
$livro_descricao =  $_POST['livro_descricao_selecionado'];
$livro_autor =  $_POST['autor_nome_selecionado'];
$livro_genero =  $_POST['genero_nome_selecionado'];
$livro_ano =  $_POST['livro_ano_selecionado'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Livro</title>
    <link rel="stylesheet" href="../css_js/css/styleLivro.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body
    style="width: 100%;height: auto; display: flex; flex-direction: column; align-items: center; background-color: #1E1E1E;">

    <header>
        <?php
        include('../componentes/pgCabecalhoPaginas.php');
        
        ?>
    </header>
    <div class="container">
        <div class="containerLivroCapa">
            <img class="imgLivroCapa" src="<?php echo $livro_capa; ?>">
            <div>
                <div class="containerInformacoesLivro">
                    <div class="containerAlinhamentoLadoEsquerdo">
                        <div>
                            <h4>Avaliação do Livro</h4>
                            <div style="display: flex; align-items: center; height: 3.25rem;">
                                <img src="../img/star.png" class="imgAvaliacao">
                                <div style="margin-left: 1.5rem; height: 3.25rem;">
                                    <div style="display: flex; height: 1.75rem;">
                                        <p>4,9</p>
                                        <p style="opacity: 20%;">/5</p>
                                    </div>
                                    <p style="height: 1.75rem;">100 mil</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4>Autor</h4>
                            <p>
                                <?php echo $livro_autor; ?>
                            </p>
                        </div>
                        <div>
                            <h4>Ano de Publicação</h4>
                            <p>
                                <?php echo $livro_ano; ?>
                            </p>
                        </div>
                    </div>

                    <div class="containerAlinhamentoLadoDireito">
                        <div>
                            <h4>Sua Avaliação</h4>
                            <div style="display: flex; margin-top: 1.37rem;">
                                <img src="../img/starAvaliacao.png" class="imgAvaliacao">
                                <div style="margin-left: 1.5rem;">
                                    <p style="color: #0A58CA; margin-left: 1.18rem;">Avaliar</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4>Gênero da Obra</h4>
                            <p>
                                <?php echo $livro_genero; ?>
                            </p>
                        </div>
                        <div>
                            <h4>Editora</h4>
                            <p>
                                <?php echo $livro_editora; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="containerDescricao">
                    <h4>Descrição</h4>
                    <p>
                        <?php echo $livro_descricao; ?>
                    </p>
                    
                   <button id="btn-favoritos" class="btn btn-warning" 
    style="width: 16.31rem; height: 3.28rem;">
    <img src="../img/coracao.png" style="width: 24px; height: 24px; margin-right: 0.5rem;">
    Adicionar aos favoritos
</button>

<?php 
$usuario_cod = $_SESSION['usuario_cod'];                            

// Verifica se o livro já está nos favoritos
$sql = "SELECT * FROM Favoritos WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_cod', $usuario_cod, PDO::PARAM_INT);
$stmt->bindParam(':livro_cod', $livro_cod, PDO::PARAM_INT);
$stmt->execute();
$favorito = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o livro já estiver nos favoritos, muda a cor e o texto do botão
if ($favorito) {
    echo "
    <script>
        const btnFav = document.getElementById('btn-favoritos');
        btnFav.classList.remove('btn-warning');
        btnFav.classList.add('btn-success');
        btnFav.innerHTML = '<img src=\"../img/coracao.png\" style=\"width: 24px; height: 24px; margin-right: 0.5rem;\">Livro adicionado aos favoritos';
    </script>";
}
?>

<script>
document.getElementById('btn-favoritos').addEventListener('click', function () {
    const livroCod = "<?php echo $livro_cod; ?>";
    const btnFav = document.getElementById('btn-favoritos');

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
            btnFav.classList.remove('btn-warning');
            btnFav.classList.remove('btn-danger');
            btnFav.classList.add('btn-success');
            btnFav.innerHTML = '<img src="../img/coracao.png" style="width: 24px; height: 24px; margin-right: 0.5rem;">Favoritado';
        } else if (data.includes("❎")) {
            // Removido dos favoritos
            btnFav.classList.remove('btn-success');
            btnFav.classList.add('btn-warning');
            btnFav.innerHTML = '<img src="../img/coracao.png" style="width: 24px; height: 24px; margin-right: 0.5rem;">Adicionar aos favoritos';
        }
    })
    .catch(error => {
        alert("Erro ao adicionar livro aos favoritos.");
        console.error(error);
    });
});
</script>


                    <button id="btn-lido" class="btn btn-info"
                        style="width: 16.31rem; height: 3.28rem; margin-left: 89px;">
                        <img src="../img/img.visto.png" style="width: 24px; height: 24px; margin-right: 0.5rem;">
                        Marcar livro como já lido
                    </button>

                    <?php 
                        $usuarioCod = $_SESSION['usuario_cod'];                            
                        $sql = "select * from livros_lidos where usuario_cod = :usuario_cod and livro_cod = :livro_cod";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':usuario_cod', $usuarioCod, PDO::PARAM_INT);
                        $stmt->bindParam(':livro_cod', $livro_cod, PDO::PARAM_INT);
                        $stmt->execute();
                        $livro_lido = $stmt->fetch(PDO::FETCH_ASSOC); 

                        if ($livro_lido){
                        echo"
                            <script>
                                const btn = document.getElementById('btn-lido');
                                btn.classList.remove('btn-info');
                                btn.classList.add('btn-success');
                                btn.innerHTML = '<img src=\"../img/img.visto.png\" style=\"width: 24px; height: 24px; margin-right: 0.5rem;\">Livro marcado como lido';
                            </script>";
                        }
                        
                    ?>

                    <script>
                        document.getElementById('btn-lido').addEventListener('click', function () {
                            const livroCod = "<?php echo $livro_cod; ?>";
                            const btn = document.getElementById('btn-lido');

                            fetch('../acoes/marcarLivroLido.php', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                                body: 'livro_cod=' + encodeURIComponent(livroCod)
                            })
                                .then(response => response.text())
                                .then(data => {
                                    alert(data);

                                    if (data.includes("✅")) {
                                        // Marcado como lido
                                        btn.classList.remove('btn-info');
                                        btn.classList.add('btn-success');
                                        btn.innerHTML = '<img src="../img/img.visto.png" style="width: 24px; height: 24px; margin-right: 0.5rem;">Livro marcado como lido';
                                    } else if (data.includes("❎")) {
                                        // Removido da lista
                                        btn.classList.remove('btn-success');
                                        btn.classList.add('btn-info');
                                        btn.innerHTML = '<img src="../img/img.visto.png" style="width: 24px; height: 24px; margin-right: 0.5rem;">Marcar livro como já lido';
                                    }
                                })
                                .catch(error => {
                                    alert("Erro ao marcar livro como lido.");
                                    console.error(error);
                                });
                        });
                    </script>

                </div>
            </div>
        </div>

        <div class="containerLivrosRecomendados">
            <h4>Livros Recomendados</h4>
            <div class="containerLivro">
                <?php
                include('../componentes/componentesPaginas_tcc/livrosRecomendados.php');
                ?>
            </div>
        </div>

        <hr>

    </div>
</body>

</html>