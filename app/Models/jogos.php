<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jogos extends Model
{
    protected $table = 'jogos';

    protected $fillable = [
        'nome',
        'genero',
        'ano',
        'plataforma'
    ];
}