<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Turma",
 *     type="object",
 *     title="Turma",
 *     required={"codigoTurma","turnoTurma"},
 *     @OA\Property(property="idTurma", type="integer", example=1, readOnly=true),
 *     @OA\Property(property="codigoTurma", type="integer", example=2026001),
 *     @OA\Property(property="turnoTurma", type="string", example="Noturno"),
 *     @OA\Property(property="datainicioTurma", type="string", format="date", example="2026-02-01"),
 *     @OA\Property(property="datafimTurma", type="string", format="date", example="2026-12-15")
 * )
 */
class Turma extends Model
{
    protected $table = 'turma';
    protected $primaryKey = 'idTurma';

    protected $fillable = [
        'codigoTurma',
        'turnoTurma',
        'datainicioTurma',
        'datafimTurma',
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'Turma_idTurma', 'idTurma');
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class, 'Turma_idTurma', 'idTurma');
    }
}
