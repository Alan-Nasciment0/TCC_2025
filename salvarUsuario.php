<?php

    switch ($_REQUEST["acao"]) {
        case 'cadastrar': 
            $usu_nome = $_POST["nome"];
            $usu_email = $_POST["email"];
            $usu_senha = $_POST["senha"];

            $sql = "sp_adicionar_usuario";
            $res = $conexao_servidor_bd->query($sql);
            break;
    }