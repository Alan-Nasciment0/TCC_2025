<?php
$foto_perfil_usuario = $_SESSION['foto_perfil_usuario'] ?? 'foto_aluno_padrao.png';
?>
<div class="barra">
    <img src="../img/Quanto_mais_você_lê_mais_você_voa__2_-removebg-preview.png" alt="Logo" class="logo">
    <div class="menu-superior">
        <nav>
            <ul>
                <li>
                    <a href="pgHome.php">Início</a>
                </li>
                <li>
                    <a href="pgRanking.php">Ranking</a>
                </li>
                <li>
                    <div class="caixa-pesquisa">
                        <form action="pgResultadoPesquisa.php" method="get">
                            <input type="text" name="pesquisaTxt" id="pesquisaTxt" placeholder="Search">
                            <button type="submit">Pesquisar</button>
                        </form>
                    </div>
                </li>
                <li>
                    <a href="pgFavorito.php">Favoritos</a>
                </li>
    </div>