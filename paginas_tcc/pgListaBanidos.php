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
    <link rel="stylesheet" href="../css_js/css/styleListaBani.css">
    <link rel="stylesheet" href="../css_js/css/styleCabecalho.css">
    <link rel="stylesheet" href="../css_js/css/styleRodape.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página lista de banidos</title>
</head>

<body>
    <header>
        <?php
        include('../componentes/componentesPaginas_tcc/pgCabecalhoPaginas.php');
        
        ?>
    </header>
    <div class="containerPrincipal">
        <div class="containerTitulo">
            <h2 class="titulo">Lista de Banido</h2>
        </div>
        <div class="containerListaBanidos">            
            <div class="containerBarra">
                <h2 class="usu">Usuário</h2>                
                <h2 class="acoe">Expira</h2>
                <h2 class="acoe">Ações</h2>
            </div>
            <div class="containerBanidos">
                <?php
                include('../componentes/componentesPaginas_tcc/banidos/buscaBanidos.php');
                ?>
            </div>            
        </div>
        <?php
        include('../componentes/componentesPaginas_tcc/rodape.php');
        ?>
</body>

<script>
document.querySelectorAll('.desbanirBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        const usuarioCod = this.dataset.banido_cod;
        if (!confirm("Deseja realmente desbanir este usuário?")) return;

        fetch('../acoes/desbanir.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `usuario_cod=${usuarioCod}`
        })
        .then(res => res.text())
        .then(msg => {
            alert(msg);
            // Remove o bloco da interface
            this.closest('.containerCampo').remove();
        })
        .catch(err => console.error(err));
    });
});
</script>

</html>