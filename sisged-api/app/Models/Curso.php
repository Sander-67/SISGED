<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Curso",
 *     type="object",
 *     title="Curso",
 *     required={"nomeCurso"},
 *     @OA\Property(property="idCurso", type="integer", example=1, readOnly=true),
 *     @OA\Property(property="Turma_idTurma", type="integer", example=1),
 *     @OA\Property(property="nomeCurso", type="string", example="Desenvolvimento Web"),
 *     @OA\Property(property="modalidadeCurso", type="string", example="EAD"),
 *     @OA\Property(property="cargahorariaCurso", type="integer", example=160),
 *     @OA\Property(property="nivelCurso", type="integer", example=1)
 * )
 */
class Curso extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'idCurso';

    protected $fillable = [
        'Turma_idTurma',
        'nomeCurso',
        'modalidadeCurso',
        'cargahorariaCurso',
        'nivelCurso',
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'Turma_idTurma', 'idTurma');
    }
}
