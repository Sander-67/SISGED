<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CursoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idCurso' => $this->idCurso,
            'Turma_idTurma' => $this->Turma_idTurma,
            'nomeCurso' => $this->nomeCurso,
            'modalidadeCurso' => $this->modalidadeCurso,
            'cargahorariaCurso' => $this->cargahorariaCurso,
            'nivelCurso' => $this->nivelCurso,
        ];
    }
}
