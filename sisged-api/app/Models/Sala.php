<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Sala",
 *     type="object",
 *     title="Sala",
 *     required={"nomeSala"},
 *     @OA\Property(property="idSala", type="integer", example=1, readOnly=true),
 *     @OA\Property(property="Aula_idAula", type="integer", example=1),
 *     @OA\Property(property="nomeSala", type="string", example="Sala 202"),
 *     @OA\Property(property="capacidadeSala", type="integer", example=30),
 *     @OA\Property(property="tipoAula", type="string", example="Laboratório"),
 *     @OA\Property(property="blocoandarAula", type="string", example="Bloco B - 2º andar")
 * )
 */
class Sala extends Model
{
    protected $table = 'sala';
    protected $primaryKey = 'idSala';

    protected $fillable = [
        'Aula_idAula',
        'nomeSala',
        'capacidadeSala',
        'tipoAula',
        'blocoandarAula',
    ];

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'Aula_idAula', 'idAula');
    }
}
