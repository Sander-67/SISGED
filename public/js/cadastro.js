const CONFIG_CADASTROS = {
    instrutores: {
        titulo: "Instrutores",
        campos: [
            { id: "nome", label: "Nome completo", tipo: "text" },
            { id: "area", label: "Área", tipo: "text" },
            { id: "email", label: "E-mail", tipo: "email" }
        ]
    },
    salas: {
        titulo: "Salas",
        campos: [
            { id: "nome", label: "Nome da sala", tipo: "text" },
            { id: "capacidade", label: "Capacidade", tipo: "number" },
            { id: "tipo", label: "Tipo", tipo: "text" }
        ]
    },
    modalidades: {
        titulo: "Modalidades",
        campos: [{ id: "nome", label: "Nome da modalidade", tipo: "text" }]
    },
    areas: {
        titulo: "Áreas",
        campos: [{ id: "nome", label: "Nome da área", tipo: "text" }]
    },
    cursos: {
        titulo: "Cursos",
        campos: [
            { id: "nome", label: "Nome do curso", tipo: "text" },
            { id: "area", label: "Área", tipo: "text" },
            { id: "cargaHoraria", label: "Carga horária", tipo: "number" }
        ]
    },
    turmas: {
        titulo: "Turmas",
        campos: [
            { id: "nome", label: "Nome da turma", tipo: "text" },
            { id: "curso", label: "Curso", tipo: "text" },
            { id: "instrutor", label: "Instrutor", tipo: "text" },
            { id: "sala", label: "Sala", tipo: "text" },
            { id: "turno", label: "Turno", tipo: "text" }
        ]
    },
    feriados: {
        titulo: "Feriados",
        campos: [
            { id: "data", label: "Data", tipo: "date" },
            { id: "descricao", label: "Descrição", tipo: "text" }
        ]
    },
    atividades: {
        titulo: "Atividades",
        campos: [
            { id: "nome", label: "Nome da atividade", tipo: "text" },
            { id: "turma", label: "Turma", tipo: "text" },
            { id: "data", label: "Data", tipo: "date" }
        ]
    }
};

const CHAVE_STORAGE_CADASTRO = "netnucleo_cadastros";

document.addEventListener("DOMContentLoaded", () => {
    preencherTopbar();

    const botoes = document.querySelectorAll(".cad-menu");
    const area = document.getElementById("areaCadastro");

    botoes.forEach(botao => {
        botao.addEventListener("click", () => {
            botoes.forEach(b => b.classList.remove("ativo"));
            botao.classList.add("ativo");
            renderizarCadastro(botao.dataset.cadastro, area);
        });
    });
});

function obterDadosStorage() {
    const dados = localStorage.getItem(CHAVE_STORAGE_CADASTRO);
    return dados ? JSON.parse(dados) : {};
}

function salvarDadosStorage(dados) {
    localStorage.setItem(CHAVE_STORAGE_CADASTRO, JSON.stringify(dados));
}

function obterRegistros(tipo) {
    const storage = obterDadosStorage();
    if (storage[tipo]) return storage[tipo];
    return (DB[tipo] || []).slice(); // começa com os dados simulados de DB
}

function renderizarCadastro(tipo, area) {
    const config = CONFIG_CADASTROS[tipo];
    if (!config || !area) return;

    const registros = obterRegistros(tipo);

    area.innerHTML = `
        <div class="cadastro-header">
            <h2>${config.titulo}</h2>
        </div>

        <form class="cadastro-form" id="formCadastro">
            ${config.campos.map(c => `
                <div class="form-group">
                    <label for="campo_${c.id}">${c.label}</label>
                    <input type="${c.tipo}" id="campo_${c.id}" name="${c.id}" required>
                </div>
            `).join("")}
            <button type="submit" class="btn-salvar">Adicionar</button>
        </form>

        <table class="cadastro-tabela" id="tabelaCadastro">
            <thead>
                <tr>
                    ${config.campos.map(c => `<th>${c.label}</th>`).join("")}
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                ${gerarLinhasTabela(registros, config)}
            </tbody>
        </table>
    `;

    document.getElementById("formCadastro").addEventListener("submit", (evento) => {
        evento.preventDefault();
        const formData = new FormData(evento.target);
        const novoRegistro = { id: Date.now() };
        config.campos.forEach(c => novoRegistro[c.id] = formData.get(c.id));

        const storage = obterDadosStorage();
        const listaAtual = obterRegistros(tipo);
        listaAtual.push(novoRegistro);
        storage[tipo] = listaAtual;
        salvarDadosStorage(storage);

        renderizarCadastro(tipo, area);
    });

    area.querySelectorAll(".btn-excluir").forEach(botao => {
        botao.addEventListener("click", () => {
            const id = Number(botao.dataset.id);
            const storage = obterDadosStorage();
            const listaAtual = obterRegistros(tipo).filter(r => r.id !== id);
            storage[tipo] = listaAtual;
            salvarDadosStorage(storage);
            renderizarCadastro(tipo, area);
        });
    });
}

function gerarLinhasTabela(registros, config) {
    if (!registros.length) {
        return `<tr><td colspan="${config.campos.length + 1}">Nenhum registro cadastrado.</td></tr>`;
    }
    return registros.map(registro => `
        <tr>
            ${config.campos.map(c => `<td>${registro[c.id] ?? "—"}</td>`).join("")}
            <td><button type="button" class="btn-excluir" data-id="${registro.id}">Excluir</button></td>
        </tr>
    `).join("");
}
