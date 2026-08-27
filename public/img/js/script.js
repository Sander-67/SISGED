function mostrarSenha() {
    const campoSenha = document.getElementById("senha");
    const tipoAtual = campoSenha.getAttribute("type");
    campoSenha.setAttribute("type", tipoAtual === "password" ? "text" : "password");
}

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".login-form");
    if (!form) return;

    form.addEventListener("submit", (evento) => {
        evento.preventDefault();

        const unidade = document.getElementById("unidade").value;
        const usuario = document.getElementById("usuario").value.trim();
        const senha = document.getElementById("senha").value.trim();

        limparErros(form);
        let valido = true;

        if (!unidade) {
            exibirErro("unidade", "Selecione uma unidade.");
            valido = false;
        }
        if (!usuario) {
            exibirErro("usuario", "Informe seu usuário institucional.");
            valido = false;
        }
        if (!senha) {
            exibirErro("senha", "Informe sua senha.");
            valido = false;
        }

        if (!valido) return;

        Sessao.salvar({
            usuario,
            nome: formatarNome(usuario),
            unidade,
            tipo: "Administrador",
            ultimoAcesso: new Date().toLocaleString("pt-BR")
        });

        window.location.href = "dashboard.html";
    });
});

function formatarNome(usuario) {
    return usuario
        .replace(/[._]/g, " ")
        .split(" ")
        .filter(Boolean)
        .map(parte => parte.charAt(0).toUpperCase() + parte.slice(1))
        .join(" ");
}

function exibirErro(idCampo, mensagem) {
    const campo = document.getElementById(idCampo);
    const grupo = campo.closest(".form-group");

    const erro = document.createElement("span");
    erro.className = "erro-campo";
    erro.textContent = mensagem;
    erro.style.color = "#e74c3c";
    erro.style.fontSize = "0.85rem";
    erro.style.display = "block";
    erro.style.marginTop = "4px";

    grupo.appendChild(erro);
    campo.setAttribute("aria-invalid", "true");
}

function limparErros(form) {
    form.querySelectorAll(".erro-campo").forEach(el => el.remove());
    form.querySelectorAll("[aria-invalid]").forEach(el => el.removeAttribute("aria-invalid"));
}
