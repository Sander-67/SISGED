<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstrutorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idInstrutor' => $this->idInstrutor,
            'Aula_idAula' => $this->Aula_idAula,
            'nomeInstrutor' => $this->nomeInstrutor,
            'cpfInstrutor' => $this->cpfInstrutor,
            'emailInstrutor' => $this->emailInstrutor,
            'telefoneInstrutor' => $this->telefoneInstrutor,
            'areaInstrutor' => $this->areaInstrutor,
            'statusInstrutor' => $this->statusInstrutor,
        ];
    }
}
