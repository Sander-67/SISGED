<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MateriaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idMateria' => $this->idMateria,
            'siglaMateria' => $this->siglaMateria,
            'nomeMateria' => $this->nomeMateria,
            'cargahorariaMateria' => $this->cargahorariaMateria,
            'ementaMateria' => $this->ementaMateria,
        ];
    }
}
