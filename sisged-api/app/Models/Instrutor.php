<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Instrutor",
 *     type="object",
 *     title="Instrutor",
 *     required={"nomeInstrutor","cpfInstrutor","emailInstrutor"},
 *     @OA\Property(property="idInstrutor", type="integer", example=1, readOnly=true),
 *     @OA\Property(property="Aula_idAula", type="integer", example=1),
 *     @OA\Property(property="nomeInstrutor", type="string", example="Carlos Souza"),
 *     @OA\Property(property="cpfInstrutor", type="integer", example=98765432100),
 *     @OA\Property(property="emailInstrutor", type="string", example="carlos.souza@email.com"),
 *     @OA\Property(property="telefoneInstrutor", type="integer", example=31991234567),
 *     @OA\Property(property="areaInstrutor", type="string", example="Backend"),
 *     @OA\Property(property="statusInstrutor", type="boolean", example=true)
 * )
 */
class Instrutor extends Model
{
    protected $table = 'instrutor';
    protected $primaryKey = 'idInstrutor';

    protected $fillable = [
        'Aula_idAula',
        'nomeInstrutor',
        'cpfInstrutor',
        'emailInstrutor',
        'telefoneInstrutor',
        'areaInstrutor',
        'statusInstrutor',
    ];

    protected $casts = [
        'statusInstrutor' => 'boolean',
    ];

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'Aula_idAula', 'idAula');
    }
}
