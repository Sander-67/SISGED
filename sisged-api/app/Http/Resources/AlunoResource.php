<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlunoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idAluno' => $this->idAluno,
            'nomeAluno' => $this->nomeAluno,
            'cpfAluno' => $this->cpfAluno,
            'emailAluno' => $this->emailAluno,
            'telefoneAluno' => $this->telefoneAluno,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
