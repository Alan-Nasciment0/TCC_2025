<?php
session_start();
include('../conexao_bd_sql/conexao_bd_mysql.php');
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const estrelas = document.querySelectorAll('.estrela');
        const livroCodEl = document.getElementById('livro_cod');
        const msg = document.getElementById('mensagem-avaliacao');

        if (!livroCodEl) return;

        const livroCod = livroCodEl.value;

        estrelas.forEach(star => {
            star.addEventListener('click', function () {
                const nota = this.getAttribute('data-nota');

                fetch('../acoes/avaliarLivro.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'livro_cod=' + encodeURIComponent(livroCod) + '&nota=' + encodeURIComponent(nota)
                })
                    .then(response => response.text())
                    .then(data => {
                        msg.innerText = data;

                        // atualiza o visual das estrelas
                        estrelas.forEach(st => {
                            if (parseInt(st.getAttribute('data-nota')) <= parseInt(nota)) {
                                st.src = '../img/star.png'; // estrela cheia
                            } else {
                                st.src = '../img/starAvaliacao.png'; // estrela vazia
                            }
                        });
                    })
                    .catch(error => {
                        alert("Erro ao enviar avaliação! Veja console.");
                        console.error(error);
                    });
            });
        });
    });
</script>


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
                                        <p>echo</p>
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
                        <div class="subContainerAlinhamento">
                            <form id="form-avaliacao" style="margin-top: 1.37rem;">
                                <div style="display: flex; gap: 8px;">
                                    <input type="hidden" id="livro_cod"
                                        value="<?php echo htmlspecialchars($livro_cod); ?>">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <img src="../img/starAvaliacao.png" class="estrela" data-nota="<?php echo $i; ?>"
                                        style="width: 32px; height: 32px; cursor: pointer;">
                                    <?php endfor; ?>
                                </div>

                            </form>
                            <p id="mensagem-avaliacao"></p>
                        </div>
                        <?php 
                        $usuarioCod = $_SESSION['usuario_cod'];
                        $sql = "SELECT nota FROM avaliacoes WHERE usuario_cod = :usuario_cod AND livro_cod = :livro_cod";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':usuario_cod', $usuarioCod, PDO::PARAM_INT);
                        $stmt->bindParam(':livro_cod', $livro_cod, PDO::PARAM_INT);
                        $stmt->execute();
                        $avaliacao = $stmt->fetch(PDO::FETCH_ASSOC);
                        $notaUsuario = $avaliacao ? (int)$avaliacao['nota'] : 0;
                        ?>
                        <script>
                            const notaSalva = <?= $notaUsuario ?>; // vinda do PHP
                            document.addEventListener("DOMContentLoaded", () => {
                                const estrelas = document.querySelectorAll(".estrela");
                                // Função para preencher as estrelas até a nota selecionada
                                function preencherEstrelas(nota) {
                                    estrelas.forEach(e => {
                                        const valor = parseInt(e.dataset.nota);
                                        e.src = valor <= nota ? "../img/star.png" : "../img/starAvaliacao.png";
                                    });
                                }
                                // Quando a página carregar, marca as estrelas salvas
                                if (notaSalva > 0) {
                                    preencherEstrelas(notaSalva);
                                }
                                // Evento de clique para nova avaliação
                                estrelas.forEach(estrela => {
                                    estrela.addEventListener("click", () => {
                                        const novaNota = parseInt(estrela.dataset.nota);
                                        preencherEstrelas(novaNota);
                                        // Enviar nova avaliação via AJAX
                                        const livroCod = document.getElementById("livro_cod").value;
                                        fetch("salvar_avaliacao.php", {
                                            method: "POST",
                                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                            body: `livro_cod=${livroCod}&nota=${novaNota}`
                                        })
                                            .then(resp => resp.text())
                                            .then(msg => {
                                                document.getElementById("mensagem-avaliacao").textContent = msg;
                                            });
                                    });
                                });
                            });
                        </script>




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

                    <button id="btn-favoritos" class="btn btn-warning" style="width: 16.31rem; height: 3.28rem;">
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
                            btnFav.innerHTML = '<img src=\"../img/coracao.png\" style=\"width: 24px; height: 24px; margin-right: 0.5rem;\">Favoritado';
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