<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdministradorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'idAdministrador' => $this->idAdministrador,
            'usuarioAdministrador' => $this->usuarioAdministrador,
            'emailAdministrador' => $this->emailAdministrador,
        ];
    }
}
