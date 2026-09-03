function mostrarSenha() {
    const campoSenha = document.getElementById("senha");
    const tipoAtual = campoSenha.getAttribute("type");
    campoSenha.setAttribute("type", tipoAtual === "password" ? "text" : "password");
}

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".login-form");
    if (!form) return;

    form.addEventListener("submit", async (evento) => {
        evento.preventDefault();

        const tipoUsuario = document.getElementById("tipoUsuario").value;
        const email = document.getElementById("email").value.trim();
        const senha = document.getElementById("senha").value.trim();

        limparErros(form);
        let valido = true;

        if (!email) {
            exibirErro("email", "Informe seu e-mail.");
            valido = false;
        }
        if (!senha) {
            exibirErro("senha", "Informe sua senha.");
            valido = false;
        }

        if (!valido) return;

        const botao = form.querySelector(".btn-login");
        botao.disabled = true;
        botao.textContent = "Entrando...";

        try {
            const rota = tipoUsuario === "aluno" ? "/auth/aluno/login" : "/auth/administrador/login";
            const corpo = tipoUsuario === "aluno"
                ? { emailAluno: email, senhaAluno: senha }
                : { emailAdministrador: email, senhaAdministrador: senha };

            const resposta = await fetch(API_BASE + rota, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify(corpo)
            });

            const dados = await resposta.json();

            if (!resposta.ok) {
                exibirErro("senha", dados.message || "E-mail ou senha inválidos.");
                return;
            }

            const nome = tipoUsuario === "aluno"
                ? dados.aluno.nomeAluno
                : dados.administrador.usuarioAdministrador;

            Sessao.salvar({
                nome,
                email,
                tipo: tipoUsuario === "aluno" ? "Aluno" : "Administrador",
                token: dados.token,
                ultimoAcesso: new Date().toLocaleString("pt-BR")
            });

            window.location.href = "dashboard.html";

        } catch (erro) {
            exibirErro("senha", "Não foi possível conectar ao servidor.");
        } finally {
            botao.disabled = false;
            botao.textContent = "Entrar no Sistema";
        }
    });
});

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