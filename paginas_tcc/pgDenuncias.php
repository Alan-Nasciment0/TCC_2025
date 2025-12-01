<?php
session_start();


$usuario_cod = $_SESSION['usuario_cod'] ?? null;


if (!$usuario_cod) {
    header('Location:pgLogin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css_js/css/styleListaDenuncias.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página lista de Denuncias</title>
</head>

<body>
    <header>
        <?php
        include('../componentes/componentesPaginas_tcc/pgCabecalhoPaginas.php');
        
        ?>
    </header>
    <div class="containerPrincipal">
        <div class="containerTitulo">
            <h2 class="titulo">Lista de Denuncias</h2>
        </div>
        <div class="containerListaBanidos">
            <div class="containerBarra">
                <h2 class="usu">Usuário</h2>
                <h2 class="exp">Comentário</h2>
                <h2 class="acoe">Motivo</h2>
                <h2 class="acoe">Ações</h2>
            </div>
            <div class="containerDenuncias">
                <?php
                include('../componentes/componentesPaginas_tcc/denuncias/buscaDenuncias.php');
                ?>
            </div>
        </div>
        <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
        ?>

        <?php
        include('../componentes/componentesPaginas_tcc/denuncias/visualizarDenuncia.php');
        ?>

        <script>

            let usuarioSelecionado = null;  
            let denunciaSelecionada = null;          

            document.addEventListener("DOMContentLoaded", function () {

                document.querySelectorAll('.imgAcoes').forEach(img => {

                    img.addEventListener('click', function () {
                        
                        usuarioSelecionado = this.dataset.usuario_cod;
                        denunciaSelecionada = this.dataset.denuncia_cod;
                        document.getElementById('modalNomeUsuario').innerText = '@' + this.dataset.nome;
                        document.getElementById('modalQtdDenuncias').innerText = 'Denúncias: ' + this.dataset.qtd;
                        document.getElementById('modalNomeLivro').innerText = this.dataset.livro;
                        document.getElementById('modalComentario').value = this.dataset.comentario;

                        if (this.dataset.foto && this.dataset.foto !== "") {
                            document.getElementById('modalFotoUsuario').src = this.dataset.foto;
                        }

                        document.getElementById('modalDenuncia').style.display = "flex";
                    });
                });

            });

            document.querySelectorAll('.ignorarBtn').forEach(btn => {
                btn.addEventListener('click', function () {
                    if (!usuarioSelecionado) return alert("Nenhum usuário selecionado.");

                    const duracao = this.dataset.duracao;
                    const motivo = "Comentário inapropriado"; // pode ser personalizado

                    if (!confirm(`Deseja ignorar esta denuncia?`)) return;

                    // AJAX
                    fetch('../acoes/banimento.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `usuario_cod=${usuarioSelecionado}&denuncia_cod=${denunciaSelecionada}&duracao=${duracao}&motivo=${encodeURIComponent(motivo)}`
                    })
                        .then(res => res.text())
                        .then(msg => {
                            alert(msg);
                            fecharModal();
                            const denunciaDiv = document.querySelector(`.denuncia-${denunciaSelecionada}`);
                            if (denunciaDiv) denunciaDiv.remove();
                        })
                        .catch(err => console.error(err));
                });
            });

            document.querySelectorAll('.banBtn').forEach(btn => {
                btn.addEventListener('click', function () {
                    if (!usuarioSelecionado) return alert("Nenhum usuário selecionado.");

                    const duracao = this.dataset.duracao;
                    const motivo = "Comentário inapropriado"; // pode ser personalizado

                    if (!confirm(`Deseja banir este usuário por ${duracao}?`)) return;

                    // AJAX
                    fetch('../acoes/banimento.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                       body: `usuario_cod=${usuarioSelecionado}&denuncia_cod=${denunciaSelecionada}&duracao=${duracao}&motivo=${encodeURIComponent(motivo)}`
                    })
                        .then(res => res.text())
                        .then(msg => {
                            alert(msg);
                            fecharModal();
                            const denunciaDiv = document.querySelector(`.denuncia-${denunciaSelecionada}`);
                            if (denunciaDiv) denunciaDiv.remove();
                        })
                        .catch(err => console.error(err));
                });
            });

            // FECHAR MODAL
            function fecharModal() {
                document.getElementById('modalDenuncia').style.display = "none";
            }
        </script>


</body>

</html>