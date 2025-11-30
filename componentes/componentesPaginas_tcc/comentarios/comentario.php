<?php
include('../buscaComentario/buscaComentario.php');
?>

<?php if (count($comentarios) > 0){ ?>
<?php foreach ($comentarios as $comentario): ?>

<div class="containerComentarioFeito">
    <img class="fotoUsuario"
        src="../img/foto_perfil_usuario/<?= htmlspecialchars($comentario['foto_perfil_usuario']) ?>">
    <div class="containerComentarioTexto">
        <div>
            <div class="containerNomeAvaliacao">
                <h6 class="nomeUsuario">@
                    <?= htmlspecialchars($comentario['usuario_nome']) ?>
                </h6>
                <?php 
                $notaComentario = isset($comentario['nota']) ? (int)$comentario['nota'] : 0;
                for ($i = 1; $i <= 5; $i++): 
                ?>
                <img src="<?= $i <= $notaComentario ? '../img/star.png' : '../img/starAvaliacao.png' ?>"
                    style="width: 20px; height: 20px; cursor: default;">
                <?php endfor; ?>
            </div>
            <textarea class="txtComentario" id="txtComentario" name="txtComentario" placeholder="Adicionar Comentario"
                disabled><?= htmlspecialchars($comentario['comentario_texto']) ?>
            </textarea>
        </div>
    </div>
    <button class="botaoDenuncia" data-id="<?= $comentario['comentario_cod'] ?>" onclick="abrirModal1(this)">
        <img class="denuncia" src="../img/menuDenuncia.png">
    </button>
</div>

<?php endforeach; ?>
<div id="modalDenuncia" class="modal-overlay">
    <div class="modal-content">
        <?php include'../componentes/pgDenuncia.php'; ?>
    </div>
</div>

<div id="modalDenuncia2" class="modal-overlay2">
    <div class="modal-content2">
        <?php include'../componentes/pgDenunciaDes.php'; ?>
    </div>
</div>

<script>
    let motivoEscolhido = null;
    let descricaoEscolhida = null;
    let idComentario = null;

    function abrirModal1(botao) {
        idComentario = botao.dataset.id; // guarda o id do comentário
        document.getElementById("modalDenuncia").style.display = "flex";
    }

    function toggleDisplay() {
        const denuncia = document.getElementById("modalDenuncia");

        if (denuncia.style.display === "none" || denuncia.style.display === "") {
            denuncia.style.display = "flex";   // Exibe
        } else {
            denuncia.style.display = "none";    // Esconde
        }
    };

    function toggleDisplay2() {
        const m2 = document.getElementById("modalDenuncia2");
        m2.style.display = (m2.style.display === "flex") ? "none" : "flex";
    };

    function abrirModal2() {
        const radio = document.querySelector('input[name="radioDefault"]:checked');

        if (!radio) {
            alert("Selecione um motivo!");
            return;
        }

        motivoEscolhido = radio.value;

        // abrir modal 2
        document.getElementById("modalDenuncia").style.display = "none";
        document.getElementById("modalDenuncia2").style.display = "flex";
    }

    document.addEventListener('click', function (event) {
        const m1 = document.getElementById('modalDenuncia');
        const m2 = document.getElementById('modalDenuncia2');

        if (event.target === m1) m1.style.display = 'none';
        if (event.target === m2) m2.style.display = 'none';
    });

    function salvarDenuncia() {
        descricaoEscolhida = document.getElementById("descricaoDenuncia").value;

        if (descricaoEscolhida.trim() === "") {
            alert("Digite uma descrição!");
            return;
        }

        const dadosFinal = {
            motivo: motivoEscolhido,
            descricao: descricaoEscolhida,
            id_comentario: idComentario
        };    

        fetch("../acoes/salvarDenuncia.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(dadosFinal)
        })
            .then(res => res.json())
            .then(data => {
        if (data.status === "sucesso") {
            alert(data.mensagem);
            document.getElementById("modalDenuncia2").style.display = "none";

            // Desativa botão de denúncia
            const botao = document.querySelector(`[data-id='${idComentario}']`);
            if (botao) botao.disabled = true;
        } else if (data.status === "ja_denunciado") {
            alert(data.mensagem);
            // Desativa botão para prevenir nova tentativa
            const botao = document.querySelector(`[data-id='${idComentario}']`);
            if (botao) botao.disabled = true;

            // Fecha modal
            document.getElementById("modalDenuncia2").style.display = "none";
        } else {
            alert(data.mensagem);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Erro ao enviar denúncia. Tente novamente.");
    });
    }
</script>
<?php }else {?>
<p style="text-align:center; opacity:0.7;">Nenhum comentário ainda.</p>
<?php
} ?>