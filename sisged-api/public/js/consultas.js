const CONFIG_CONSULTAS = {
    horario: {
        titulo: "Consulta de Horário",
        colunas: ["Turma", "Curso", "Instrutor", "Sala", "Turno"],
        linhas: () => DB.turmas.map(t => [t.nome, t.curso, t.instrutor, t.sala, t.turno])
    },
    instrutor: {
        titulo: "Consulta de Instrutor",
        colunas: ["Nome", "Área", "E-mail"],
        linhas: () => DB.instrutores.map(i => [i.nome, i.area, i.email])
    },
    "instrutor-calendario": {
        titulo: "Calendário do Instrutor",
        colunas: ["Instrutor", "Turma", "Turno"],
        linhas: () => DB.turmas.map(t => [t.instrutor, t.nome, t.turno])
    },
    sala: {
        titulo: "Consulta de Sala",
        colunas: ["Sala", "Capacidade", "Tipo"],
        linhas: () => DB.salas.map(s => [s.nome, s.capacidade, s.tipo])
    },
    "sala-calendario": {
        titulo: "Calendário de Sala",
        colunas: ["Sala", "Turma", "Turno"],
        linhas: () => DB.turmas.map(t => [t.sala, t.nome, t.turno])
    },
    "materias-turma": {
        titulo: "Matérias por Turma",
        colunas: ["Turma", "Curso", "Disciplina"],
        linhas: () => DB.turmas.map(t => [t.nome, t.curso, DB.disciplinas[0]?.nome ?? "—"])
    },
    "materias-lancar": {
        titulo: "Matérias a Lançar",
        colunas: ["Turma", "Disciplina", "Situação"],
        linhas: () => DB.turmas.map(t => [t.nome, DB.disciplinas[1]?.nome ?? "—", "Pendente"])
    },
    programacao: {
        titulo: "Programação de Turmas",
        colunas: ["Turma", "Curso", "Início", "Turno"],
        linhas: () => DB.turmas.map(t => [t.nome, t.curso, "—", t.turno])
    },
    ocorrencias: {
        titulo: "Ocorrências",
        colunas: ["Turma", "Data", "Descrição"],
        linhas: () => DB.ocorrencias.map(o => [o.turma, formatarData(o.data), o.descricao])
    }
};

document.addEventListener("DOMContentLoaded", () => {
    preencherTopbar();

    const botoes = document.querySelectorAll(".consulta-menu");
    const area = document.getElementById("areaConsulta");

    botoes.forEach(botao => {
        botao.addEventListener("click", () => {
            botoes.forEach(b => b.classList.remove("ativo"));
            botao.classList.add("ativo");
            renderizarConsulta(botao.dataset.consulta, area);
        });
    });
});

function renderizarConsulta(tipo, area) {
    const config = CONFIG_CONSULTAS[tipo];
    if (!config || !area) return;

    const linhas = config.linhas();

    area.innerHTML = `
        <div class="consulta-header">
            <h2>${config.titulo}</h2>
            <div class="consulta-filtro">
                <input type="search" id="filtroConsulta" placeholder="Filtrar resultados...">
            </div>
        </div>
        <table class="consulta-tabela" id="tabelaConsulta">
            <thead>
                <tr>${config.colunas.map(c => `<th>${c}</th>`).join("")}</tr>
            </thead>
            <tbody>
                ${linhas.length
                    ? linhas.map(linha => `<tr>${linha.map(v => `<td>${v}</td>`).join("")}</tr>`).join("")
                    : `<tr><td colspan="${config.colunas.length}">Nenhum registro encontrado.</td></tr>`}
            </tbody>
        </table>
    `;

    document.getElementById("filtroConsulta").addEventListener("input", (evento) => {
        const termo = evento.target.value.trim().toLowerCase();
        document.querySelectorAll("#tabelaConsulta tbody tr").forEach(tr => {
            tr.style.display = tr.textContent.toLowerCase().includes(termo) ? "" : "none";
        });
    });
}

function formatarData(dataISO) {
    const [ano, mes, dia] = dataISO.split("-");
    return `${dia}/${mes}/${ano}`;
}
