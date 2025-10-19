<?php
if($_SESSION['nivel_acesso'] == 1) {?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
</head>

<body class="containerEBAAA">
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
                            <input type="text" placeholder="Search">
                            <button>Pesquisar</button>
                        </div>
                    </li>
                    <li>
                        <a href="pgFavorito.php">Favoritos</a>
                    </li>
                    <li>
                        <a><img class="fotoUsuario" src="../img/autor.jpg"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</body>

</html><?php
}else if($_SESSION['nivel_acesso'] == 2) {?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
</head>

<body class="containerEBAAA">
    <div class="barra">
        <img src="../img/Quanto_mais_você_lê_mais_você_voa__2_-removebg-preview.png" alt="Logo" class="logo">
        <div class="menu-superior">
            <nav>
                <ul>
                    <li>
                        <a href="../index.php">Início</a>
                    </li>
                    <li>
                        <a href="pgRanking.php">Ranking</a>
                    </li>
                    <li>
                        <div class="caixa-pesquisa">
                            <input type="text" placeholder="Search">
                            <button>Pesquisar</button>
                        </div>
                    </li>
                    <li>
                        <a href="pgFavorito.php">Favoritos</a>
                    </li>
                    <li>
                        <a><img class="fotoUsuario" src="../img/autor.jpg"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</body>

</html><?php
}else if($_SESSION['nivel_acesso'] == 3) {?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
</head>

<body class="containerEBAAA">
    <div class="barra">
        <img src="../img/Quanto_mais_você_lê_mais_você_voa__2_-removebg-preview.png" alt="Logo" class="logo">
        <div class="menu-superior">
            <nav>
                <ul>
                    <li>
                        <a href="../index.php">Início</a>
                    </li>
                    <li>
                        <a href="pgRanking.php">Ranking</a>
                    </li>
                    <li>
                        <div class="caixa-pesquisa">
                            <input type="text" placeholder="Search">
                            <button>Pesquisar</button>
                        </div>
                    </li>
                    <li>
                        <a href="pgFavorito.php">Favoritos</a>
                    </li>
                    <li>
                        <a><img class="fotoUsuario" src="../img/autor.jpg"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</body>

</html><?php
}