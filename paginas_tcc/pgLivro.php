<?php
session_start();
include('../conexao_bd_sql/conexao_bd_mysql.php');
include('../BuscaLivros/buscaLivros.php');
include('../BuscaMediaAvaliacao/buscaMediaAvaliacao.php');

$usuario_cod = $_SESSION['usuario_cod'] ?? null;
$foto_perfil_usuario = $_SESSION['foto_perfil_usuario'] ?? '../img/userPadrao.png';

// Se não estiver logado, manda para login ANTES de tudo
if (!$usuario_cod) {
    header('Location: pglogin.php');
    exit;
}

$livro_cod = $_GET['livro_cod'] ?? null;

$sql = "SELECT 
    l.livro_cod,
    l.livro_titulo,
    l.livro_capa_link,
    l.livro_editora,
    l.livro_ano,
    l.livro_descricao,
    GROUP_CONCAT(DISTINCT CONCAT(a.autor_cod, '::', a.autor_nome) SEPARATOR '||') AS autores,
    GROUP_CONCAT(DISTINCT g.genero_nome ORDER BY g.genero_nome SEPARATOR ', ') AS genero,
    GROUP_CONCAT(DISTINCT c.categoria_nome ORDER BY c.categoria_nome SEPARATOR ', ') AS categoria
FROM livros l
LEFT JOIN autorLivro al ON l.livro_cod = al.livro_cod
LEFT JOIN autor a ON al.autor_cod = a.autor_cod
LEFT JOIN livroGenero lg ON l.livro_cod = lg.livro_cod
LEFT JOIN genero g ON lg.genero_cod = g.genero_cod
LEFT JOIN categoria c ON g.categoria_cod = c.categoria_cod
WHERE l.livro_cod = :livro_cod
GROUP BY l.livro_cod";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':livro_cod', $livro_cod, PDO::PARAM_INT);
$stmt->execute();
$livro_pagina = $stmt->fetch(PDO::FETCH_ASSOC);

// AGORA sim faz o insert no histórico
$sql = "INSERT INTO historico_visualizacao (usuario_cod, livro_cod) 
        VALUES (:usuario_cod, :livro_cod)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_cod', $usuario_cod, PDO::PARAM_INT);
$stmt->bindParam(':livro_cod', $livro_pagina['livro_cod'], PDO::PARAM_INT);
$stmt->execute();


if (!$usuario_cod) {
    header('Location:pglogin.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Livro</title>
    <link rel="stylesheet" href="../css_js/css/styleLivro.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleContainerLivros.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body
    style="width: 100%;height: auto; display: flex; flex-direction: column; align-items: center; background-color: #1E1E1E;">

    <header>
        <?php
        include('../componentes/componentesPaginas_tcc/pgCabecalhoPaginas.php');
        
        ?>
    </header>
    <div class="container">
        <div class="containerLivroCapa">
            <img class="imgLivroCapa" src="<?php echo $livro_pagina['livro_capa_link'] ?>">
            <div>
                <div class="containerInformacoesLivro">
                    <div class="containerAlinhamentoLadoEsquerdo">
                        <div>
                            <h4>Avaliação do Livro</h4>
                            <div style="display: flex; align-items: center; height: 3.25rem;">
                                <img src="../img/star.png" class="imgAvaliacao">
                                <div style="margin-left: 1.5rem; height: 3.25rem;">
                                    <div style="display: flex; height: 1.75rem;">
                                        <p>
                                            <?php echo number_format($mediaAvaliacao['media'], 1); ?>
                                        </p>
                                        <p style="opacity: 20%;">/5</p>
                                    </div>
                                    <p style="height: 1.75rem;">
                                        <?php echo htmlspecialchars($mediaAvaliacao['total_avaliacoes']); ?> avaliações
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h4>Autor</h4>
                                <p>
                                    <?php
                                $autores = explode('||', $livro_pagina['autores']);
                                foreach ($autores as $autor) {
                                list($autor_cod, $autor_nome) = explode('::', $autor);
                                
                                echo '<a href="pgAutor.php?autor_cod=' . $autor_cod . '" style="color: #0af;">' 
                                 . htmlspecialchars($autor_nome) . 
                                 '</a><br>';
                                }
                                ?>
                                </p>
                            </div>
                            <div>
                                <h4>Ano de Publicação</h4>
                                <p>
                                    <?php echo $livro_pagina['livro_ano']; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="containerAlinhamentoLadoDireito">
                        <div class="subContainerAlinhamento">
                            <form id="form-avaliacao" style="margin-top: 1.37rem;">
                                <div style="display: flex; gap: 8px;">
                                    <input type="hidden" id="livro_cod"
                                        value="<?php echo htmlspecialchars($livro_pagina['livro_cod']); ?>">
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
                        $stmt->bindParam(':livro_cod', $livro_pagina['livro_cod'], PDO::PARAM_INT);
                        $stmt->execute();
                        $avaliacao = $stmt->fetch(PDO::FETCH_ASSOC);
                        $notaUsuario = $avaliacao ? (int)$avaliacao['nota'] : 0;
                        ?>
                        <script>
                            const notaSalva = <?= $notaUsuario ?>; // vinda do PHP
                            document.addEventListener("DOMContentLoaded", () => {
                                const estrelas = document.querySelectorAll(".estrela");
                                const mensagem = document.getElementById("mensagem-avaliacao");
                                const livroCod = document.getElementById("livro_cod").value;

                                let notaSalvaAtual = <?= $notaUsuario ?>;

                                // Função para preencher as estrelas até a nota selecionada
                                function preencherEstrelas(nota) {
                                    estrelas.forEach(e => {
                                        const valor = parseInt(e.dataset.nota);
                                        e.src = valor <= nota ? "../img/star.png" : "../img/starAvaliacao.png";
                                    });
                                }
                                // Quando a página carregar, marca as estrelas salvas
                                if (notaSalvaAtual > 0) {
                                    preencherEstrelas(notaSalvaAtual);
                                }
                                // Evento de clique para nova avaliação
                                estrelas.forEach(estrela => {
                                    estrela.addEventListener("click", () => {
                                        let novaNota = parseInt(estrela.dataset.nota);
                                        preencherEstrelas(novaNota);

                                        if (notaSalvaAtual === novaNota) {
                                            novaNota = 0;
                                        }

                                        // Enviar nova avaliação via AJAX                                        
                                        fetch("../acoes/avaliarLivro.php", {
                                            method: "POST",
                                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                            body: `livro_cod=${livroCod}&nota=${novaNota}`
                                        })
                                            .then(resp => resp.text())
                                            .then(msg => {
                                                mensagem.textContent = msg;

                                                notaSalvaAtual = novaNota;
                                                preencherEstrelas(notaSalvaAtual);
                                            });
                                    });
                                });
                            });
                        </script>




                        <div>
                            <h4>Gênero da Obra</h4>
                            <p>
                                <?php echo $livro_pagina['genero']; ?>
                            </p>
                        </div>
                        <div>
                            <h4>Editora</h4>
                            <p>
                                <?php echo $livro_pagina['livro_editora']; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="containerDescricao">
                    <h4>Descrição</h4>
                    <p>
                        <?php echo $livro_pagina['livro_descricao']; ?>
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
                    $stmt->bindParam(':livro_cod', $livro_pagina['livro_cod'], PDO::PARAM_INT);
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
                            const livroCod = "<?php echo $livro_pagina['livro_cod']; ?>";
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
                        $stmt->bindParam(':livro_cod', $livro_pagina['livro_cod'], PDO::PARAM_INT);
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
                            const livroCod = "<?php echo $livro_pagina['livro_cod']; ?>";
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
            <div class="containerLivroRecomendado">
                <?php
                include('../componentes/componentesPaginas_tcc/livrosRecomendadosAutorGeneroCategoria.php');
                ?>
            </div>
        </div>

        <div class="containerComentarios">
            <div class="titulo">
                <h4>Comentários</h4>
            </div>
            <?php
            $usuario_cod = $_SESSION['usuario_cod'] ?? null;
            $sql = "
                   SELECT data_fim
                    FROM Banimentos
                    WHERE usuario_cod = :usuario_cod
                      AND (data_fim IS NULL OR data_fim > NOW())
                    ORDER BY 
                      CASE 
                        WHEN data_fim IS NULL THEN 1 
                        ELSE 0 
                      END DESC, 
                      data_fim DESC
                    LIMIT 1;";                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':usuario_cod' => $usuario_cod]);
                    $ban = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($ban !== false) {
                    // Banimento encontrado, pode acessar $ban['data_fim']
                    if ($ban['data_fim'] !== null) {
                         echo "<h6 class='banido'>Você está impossibilitado de fazer comentários temporariamente.</h6>";
                        echo "<h6 class='banido'>Seu banimento vence em " . date('d/m/Y', strtotime($ban['data_fim'])) . ".</h6>";
                        ?>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                document.querySelectorAll('.containerComentarioRealizados, .containerAddComentario')
                                    .forEach(el => el.style.display = 'none');
                            });
                        </script><?php
                    } else {
                        echo "Banimento permanente.";
                    }
                    } else {
                        // Não existe banimento ativo
                        // Aqui você pode exibir a página normalmente
                    }                        
                ?>
            <div class="containerAddComentario">
                <img class="fotoUsuario" src="../img/foto_perfil_usuario/<?= htmlspecialchars($foto_perfil_usuario) ?>">
                <form action="../acoes/adicionarComentario.php" method="post" class="formComentario">
                    <input type="hidden" name="livro_cod" value="<?= $livro_pagina['livro_cod'] ?>">
                    <textarea class="txtComentario" id="txtComentario" name="txtComentario"
                        placeholder="Adicionar Comentario"></textarea>
                    <div class="botoesComentario">
                        <button class="botaoComentarioCancelar" name="btnCancelar" type="reset"
                            value="Cancelar">Cancelar</button>
                        <button class="botaoComentario" name="btnComentar" type="submit"
                            value="Comentar">Comentar</button>
                    </div>
                </form>
            </div>

            <script>
                const usuario_cod = <?= $_SESSION["usuario_cod"] ?>;
                const textarea = document.getElementById('txtComentario');
                const btnCancelar = document.querySelector('button[value="Cancelar"]');
                const btnComentar = document.querySelector('button[value="Comentar"]');

                async function usuarioAvaliou(usuario_cod, livro_cod) {
                    const resposta = await fetch(`../buscaAvaliacao/buscaAvaliacao.php?usuario_cod=${usuario_cod}&livro_cod=${livro_cod}`);
                    const dados = await resposta.json();
                    return dados.total > 0;
                }

                btnCancelar.disabled = true;
                btnComentar.disabled = true;

                textarea.addEventListener('focus', async function (event) {
                    const livro_cod = <?= $livro_pagina['livro_cod'] ?>;

                    const avaliou = await usuarioAvaliou(usuario_cod, livro_cod);

                    if (!avaliou) {
                        alert("Você ainda não avaliou este livro.");

                        textarea.blur();

                    } else {
                        textarea.disabled = false;
                        btnCancelar.disabled = false;
                        btnComentar.disabled = false;
                    }
                });

            </script>

            <div class="containerComentarioRealizados">
                <?php
                include('../componentes/componentesPaginas_tcc/comentarios/comentario.php');
                ?>
            </div>

        </div>

    </div>

    <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
    ?>

    <script>
        document.querySelectorAll('.marcador').forEach(btn => {
            btn.addEventListener('click', function () {
                const livroCod = this.getAttribute('data-livro-cod');
                const img = this.querySelector('img');

                fetch('../acoes/adicionarLivrosFavoritos.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'livro_cod=' + encodeURIComponent(livroCod)
                })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);

                        if (data.includes("✅")) {
                            img.src = '../img/bookmark_preenchido.png';
                        } else if (data.includes("❎")) {
                            img.src = '../img/salvar_livro.png';
                        }
                    })
                    .catch(error => {
                        alert("Erro ao adicionar livro aos favoritos.");
                        console.error(error);
                    });
            });
        });
    </script>


</body>

</html>