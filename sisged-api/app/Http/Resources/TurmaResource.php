<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TurmaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idTurma' => $this->idTurma,
            'codigoTurma' => $this->codigoTurma,
            'turnoTurma' => $this->turnoTurma,
            'datainicioTurma' => $this->datainicioTurma,
            'datafimTurma' => $this->datafimTurma,
        ];
    }
}
