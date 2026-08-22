const DB = {
    instrutores: [
        { id: 1, nome: "Carlos Andrade", area: "Programação", email: "carlos.andrade@netnucleo.edu" },
        { id: 2, nome: "Fernanda Lima", area: "Design", email: "fernanda.lima@netnucleo.edu" },
        { id: 3, nome: "Rodrigo Souza", area: "Redes", email: "rodrigo.souza@netnucleo.edu" }
    ],
    salas: [
        { id: 1, nome: "Sala 01", capacidade: 25, tipo: "Teórica" },
        { id: 2, nome: "Sala 02", capacidade: 20, tipo: "Laboratório" },
        { id: 3, nome: "Sala 03", capacidade: 30, tipo: "Teórica" }
    ],
    modalidades: [
        { id: 1, nome: "Presencial" },
        { id: 2, nome: "EAD" },
        { id: 3, nome: "Híbrido" }
    ],
    areas: [
        { id: 1, nome: "Tecnologia da Informação" },
        { id: 2, nome: "Administração" },
        { id: 3, nome: "Design Gráfico" }
    ],
    cursos: [
        { id: 1, nome: "Desenvolvimento Web", area: "Tecnologia da Informação", cargaHoraria: 160 },
        { id: 2, nome: "Gestão de Projetos", area: "Administração", cargaHoraria: 80 }
    ],
    turmas: [
        { id: 1, nome: "DW-2026/1", curso: "Desenvolvimento Web", instrutor: "Carlos Andrade", sala: "Sala 02", turno: "Noite" },
        { id: 2, nome: "GP-2026/1", curso: "Gestão de Projetos", instrutor: "Fernanda Lima", sala: "Sala 01", turno: "Manhã" }
    ],
    feriados: [
        { id: 1, data: "2026-09-07", descricao: "Independência do Brasil" },
        { id: 2, data: "2026-11-02", descricao: "Finados" }
    ],
    atividades: [
        { id: 1, nome: "Prova Bimestral", turma: "DW-2026/1", data: "2026-09-15" }
    ],
    alunos: [
        { matricula: "2026001", nome: "Ana Beatriz Souza", turma: "DW-2026/1" },
        { matricula: "2026002", nome: "João Pedro Martins", turma: "GP-2026/1" },
        { matricula: "2026003", nome: "Larissa Costa", turma: "DW-2026/1" }
    ],
    ocorrencias: [
        { id: 1, turma: "DW-2026/1", data: "2026-08-10", descricao: "Ausência coletiva por falta de energia" }
    ],
    disciplinas: [
        { id: 1, nome: "HTML e CSS" },
        { id: 2, nome: "JavaScript" },
        { id: 3, nome: "Gestão Ágil" }
    ],
    telefonica: [
        { nome: "Secretaria", ramal: "1001" },
        { nome: "Coordenação Pedagógica", ramal: "1002" },
        { nome: "TI / Suporte", ramal: "1003" }
    ]
};

const Sessao = {
    CHAVE: "netnucleo_usuario",

    salvar(usuario) {
        sessionStorage.setItem(this.CHAVE, JSON.stringify(usuario));
    },

    obter() {
        const dados = sessionStorage.getItem(this.CHAVE);
        return dados ? JSON.parse(dados) : null;
    },

    limpar() {
        sessionStorage.removeItem(this.CHAVE);
    },

    exigirLogin() {
        if (!this.obter()) {
            window.location.href = "login.html";
        }
    }
};

function preencherTopbar() {
    const usuario = Sessao.obter();
    if (!usuario) return;

    const nomeEl = document.querySelector(".user-info strong");
    const tipoEl = document.querySelector(".user-info span");

    if (nomeEl && !nomeEl.id) nomeEl.textContent = usuario.nome;
    if (tipoEl && !tipoEl.id) tipoEl.textContent = usuario.tipo;
}
