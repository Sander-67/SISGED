<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Materia",
 *     type="object",
 *     title="Materia",
 *     required={"nomeMateria"},
 *     @OA\Property(property="idMateria", type="integer", example=1, readOnly=true),
 *     @OA\Property(property="siglaMateria", type="string", example="POO"),
 *     @OA\Property(property="nomeMateria", type="string", example="Programação Orientada a Objetos"),
 *     @OA\Property(property="cargahorariaMateria", type="string", example="40:00:00"),
 *     @OA\Property(property="ementaMateria", type="string", example="Conceitos de POO em PHP e Java")
 * )
 */
class Materia extends Model
{
    protected $table = 'materia';
    protected $primaryKey = 'idMateria';

    protected $fillable = [
        'siglaMateria',
        'nomeMateria',
        'cargahorariaMateria',
        'ementaMateria',
    ];
}
