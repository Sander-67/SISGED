<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idSala' => $this->idSala,
            'Aula_idAula' => $this->Aula_idAula,
            'nomeSala' => $this->nomeSala,
            'capacidadeSala' => $this->capacidadeSala,
            'tipoAula' => $this->tipoAula,
            'blocoandarAula' => $this->blocoandarAula,
        ];
    }
}
