<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jogos extends Model
{
    protected $table = 'jogos';

    protected $fillable = [
        'id_remetente',
        'tipo_remetente',
        'id_destinatario',
        'tipo_destinatario',
        'status'
    ];
}