<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../css_js/css/styleLogin.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de login-TCC</title>
</head>

<body>
    <?php
    if (isset($_SESSION['emailVazio'])){?>
    <div id="modalAvisoEmailVazio" class="modal-overlay-InfoAlterado">
        <div class="modal-content-InfoAlterado">
            <?php include('../componentes/componentesPaginas_tcc/avisoEmailVazio.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoEmailVazio');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['emailVazio']); ?>
    <?php
    }else if (isset($_SESSION['senhaVazia'])){?>
    <div id="modalAvisoSenhaVazia" class="modal-overlay-InfoAlterado">
        <div class="modal-content-InfoAlterado">
            <?php include('../componentes/componentesPaginas_tcc/avisoSenhaVazia.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoSenhaVazia');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['senhaVazia']); ?>
    <?php
    }else if (isset($_SESSION['emailErrado'])){?>
    <div id="modalAvisoEmailErrado" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoEmailErrado.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoEmailErrado');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['emailErrado']); ?>
    <?php
    }else if (isset($_SESSION['senhaErrada'])){?>
    <div id="modalAvisoSenhaErrada" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoSenhaErrada.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoSenhaErrada');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['senhaErrada']); ?>
    <?php
    }?>
    <div class="containerPrincipal">
        <div class="containerLogin">
            <div class="containerLogo">
                <a class="logo" href=""><img src="../img/img.teste.webp"></a>
            </div>
            <h2 class="titulo">Fazer login</h2>
            <form action="../salvarUsuario.php" method="post">
                <div class="containerPreencher0">
                    <label>Email</label>
                    <div class="campoPreencher">
                        <input class="placeHolder" type="text" id="email" name="email" placeholder="Digite seu email"
                            class="text-body-secondary">
                    </div>
                </div>

                <div class="containerPreencher1">
                    <label>Senha</label>
                    <div class="campoPreencher">
                        <a class="imgMiniatura" href="" style="width: 24px; height: 24px; position: absolute;"><img
                                src="../img/img.senha.png"></a>
                        <input class="placeHolder" type="password" id="senha" name="senha"
                            placeholder="Digite sua senha." class="text-body-secondary">
                    </div>
                </div>

                <div class="esqueciaSenha">
                    <a class="link-opacity-100" href="#">Esqueci a senha</a>
                </div>

                <div class="botoes">
                    <input type="submit" name="login" value="Entrar">
                    <input type="submit" name="pgCriar_conta" value="Criar conta" style="margin-left: 135px;">
                </div>
            </form>
        </div>
    </div>
</body>

</html>