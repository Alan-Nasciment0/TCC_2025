<?php
session_start();

include('../BuscaLivros/buscaLivros.php');

$autor_cod = $_POST['cod_autor_selecionado']; 
$autor_nome = $_POST['nome_autor_selecionado'];
$autor_data_nascimento =  $_POST['autor_data_nascimento_selecionado'];
$autor_data_falecimento = $_POST['autor_data_falecimento_selecionado'];
$autor_movimento_literario =  $_POST['autor_movimento_literario_selecionado'];
$autor_biografia =  $_POST['autor_biografia_selecionado'];
$autor_link_foto =  $_POST['autor_link_foto_selecionado'];


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Autor</title>
    <link rel="stylesheet" href="../css_js/css/styleAutor.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
</head>

<body style="width: 100%;height: auto; display: flex; flex-direction: column; align-items: center; background-color: #1E1E1E;">

    <header>
        <?php
        include('../componentes/pgCabecalhoPaginas.php');
        
        ?>
    </header>

    <div class="container">
        <div class="containerAutor">
            <img class="imgAutor" src="<?php echo $autor_link_foto; ?>">

            <div class="containerInformacoesAutor">
                <div class="containerNome">
                    <h4>Autor</h4>
                    <p><?php echo $autor_nome; ?></p>
                </div>

                <div class="containerAlinhamento">

                    <div class="containerMovimentoLiterário">
                        <h4>Movimento Literário</h4>
                        <p><?php echo $autor_movimento_literario; ?></p>
                    </div>
                    <div class="containerNascimento">
                        <h4>Nascimento</h4>
                        <p><?php echo $autor_data_nascimento; ?></p>
                    </div>
                    <div class="containerFalecimento">
                        <h4>Falecimento</h4>
                        <p><?php echo $autor_data_falecimento; ?></p>
                    </div>

                </div>

                <div class="containerBiografia">

                    <h4>Biografia</h4>
                    <p><?php echo $autor_biografia; ?></p>

                </div>

            </div>
        </div>

        <div class="containerPrincipaisObras">
            <h4>Principais Obras</h4>
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