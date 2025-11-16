<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="../css_js/css/styleCadastro.css">
    <link rel="stylesheet" href="../css_js/bootstrap/css/bootstrap.min.css">
    <script src="../css_js/bootstrap/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de cadastro-TCC</title>
</head>

<body>
    <?php
    if (isset($_SESSION['nomeVazio'])){?>
    <div id="modalAvisoNomeVazio" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoNomeVazio.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoNomeVazio');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['nomeVazio']); ?>
    <?php
    }else if (isset($_SESSION['emailVazio'])){?>
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
    }else if (isset($_SESSION['senhaDiferentes'])){?>
    <div id="modalAvisoSenhaDiferente" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoSenhaDiferentes.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoSenhaDiferente');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['senhaDiferentes']); ?>
    <?php
    }else if (isset($_SESSION['emailExistente'])){?>
    <div id="modalAvisoEmailExistente" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoEmailExistente.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoEmailExistente');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['emailExistente']); ?>
    <?php
    }else if (isset($_SESSION['contaCadastrada'])){?>
    <div id="modalAvisoContaCadastrada" class="modal-overlay-InfoSalva">
        <div class="modal-content-InfoSalva">
            <?php include('../componentes/componentesPaginas_tcc/avisoContaCadastrada.php'); ?>
        </div>
    </div>
    <script>
        // Fechar o modal ao clicar fora dele
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modalAvisoContaCadastrada');
            if (event.target === modal) {
                modal.style.display = 'none';

            }
        });
    </script>
    <?php unset($_SESSION['contaCadastrada']); ?>
    <?php
    }?>
    <div class="containerPrincipal">
        <div class="containerLogin">
            <h2 class="titulo">Fazer cadastro</h2>
            <div class="containerLogo">
                <a class="logo" href=""><img src="../img/img.teste.webp"></a>
            </div>
            <form action="../salvarUsuario.php" method="post">
                <input type="hidden" name="acao" value="cadastrar">
                <div class="containerPreencher0">
                    <label>Nome do usuário</label>
                    <div class="campoPreencher">
                        <input class="placeHolder" type="text" id="nome" name="nome" placeholder="Digite seu nome"
                            class="text-body-secondary">
                    </div>
                </div>

                <div class="containerPreencher1">
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

                <div class="containerPreencher1">
                    <label>Confirma a senha</label>
                    <div class="campoPreencher">
                        <a class="imgMiniatura" href="" style="width: 24px; height: 24px; position: absolute;"><img
                                src="../img/img.senha.png"></a>
                        <input class="placeHolder" type="password" id="confirmaSenha" name="confirmaSenha"
                            placeholder="Digite novamente a senha" class="text-body-secondary">
                    </div>
                </div>

                <div class="botoes">
                    <input type="submit" name="Criar conta" value="Criar conta">
                </div>
            </form>
        </div>
    </div>
</body>

</html>