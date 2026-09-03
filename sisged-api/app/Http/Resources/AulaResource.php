<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AulaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idAula' => $this->idAula,
            'Administrador_idAdministrador' => $this->Administrador_idAdministrador,
            'Aluno_idAluno' => $this->Aluno_idAluno,
            'Materia_idMateria' => $this->Materia_idMateria,
            'Turma_idTurma' => $this->Turma_idTurma,
            'dataAula' => $this->dataAula,
            'horarioinicioAula' => $this->horarioinicioAula,
            'horariofimAula' => $this->horariofimAula,
            'duracaoAula' => $this->duracaoAula,
            'tipoAula' => $this->tipoAula,
            'statusAula' => $this->statusAula,
        ];
    }
}
