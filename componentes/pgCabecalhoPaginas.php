<?php
if (!isset($_SESSION['nivel_acesso'])) {
    header("Location: login.php");
    exit;
}

if($_SESSION['nivel_acesso'] == 1) {?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
</head>

<body class="containerEBAAA">
    <?php
        include('../componentes/componentesCabecalho/menuPadrao.php');        
    ?>
        <div class="containerDropDown">
            <li class="containerItem">
                <div class="dropDown">
                    <button class="dropDownBotao" onclick="toggleAparecerMenu()"><img class="fotoUsuario"
                            src="../img/autor.jpg"></button>
                    <nav id="menuDropDown" class="containerMenu">
                        <ul class="containerItens">
                            <li class="containerItem">
                                <a class="itemMenu" href="pgPerfil.php">
                                    <img class="imgMenu" src="../img/usuário 1.png">Perfil
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/historico 1.png">Histórico
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="../index.php">
                                    <img class="imgMenu" src="../img/desconectar 1.png">Desconectar
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </li>
            </ul>
            </nav>
        </div>
    </div>
    <?php
        include('../componentes/componentesCabecalho/aparecerMenu.php');        
    ?>
</body>

</html>
<?php
}else if($_SESSION['nivel_acesso'] == 2) {?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
</head>

<body class="containerEBAAA">
    <?php
        include('../componentes/componentesCabecalho/menuPadrao.php');        
    ?>
        <div class="containerDropDown">
            <li class="containerItem">
                <div class="dropDown">
                    <button class="dropDownBotao" onclick="toggleAparecerMenu()"><img class="fotoUsuario"
                            src="../img/img.teste.webp"></button>
                    <nav id="menuDropDown" class="containerMenu">
                        <ul class="containerItens">
                            <li class="containerItem">
                                <a class="itemMenu" href="pgPerfil.php">
                                    <img class="imgMenu" src="../img/usuário 1.png">Perfil
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/historico 1.png">Histórico
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/denunciaIcone.png">Denúncias
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/banIcone.png">Banidos
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="../index.php">
                                    <img class="imgMenu" src="../img/desconectar 1.png">Desconectar
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </li>
            </ul>
            </nav>
        </div>
    </div>
    <?php
        include('../componentes/componentesCabecalho/aparecerMenu.php');        
    ?>

</body>

</html>
<?php
}else if($_SESSION['nivel_acesso'] == 3) {?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
</head>

<body class="containerEBAAA">
    <?php
        include('../componentes/componentesCabecalho/menuPadrao.php');        
    ?>
        <div class="containerDropDown">
            <li class="containerItem">
                <div class="dropDown">
                    <button class="dropDownBotao" onclick="toggleAparecerMenu()"><img class="fotoUsuario"
                            src="../img/img.teste.webp"></button>
                    <nav id="menuDropDown" class="containerMenu">
                        <ul class="containerItens">
                            <li class="containerItem">
                                <a class="itemMenu" href="pgPerfil.php">
                                    <img class="imgMenu" src="../img/usuário 1.png">Perfil
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/historico 1.png">Histórico
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/denunciaIcone.png">Denúncias
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/banIcone.png">Banidos
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/adicionarIcone.png">Adicionar Moderador
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/bookAdicionarIcone.png">Manter Livros
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="pgHistorico.php">
                                    <img class="imgMenu" src="../img/bookAdicionarIcone.png">Manter Autor
                                </a>
                            </li>

                            <li class="containerItem">
                                <a class="itemMenu" href="../index.php">
                                    <img class="imgMenu" src="../img/desconectar 1.png">Desconectar
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </li>
            </ul>
            </nav>
        </div>
    </div>
    <?php
        include('../componentes/componentesCabecalho/aparecerMenu.php');        
    ?>

</body>

</html>
<?php
}