<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes'; // define a tabela correta

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'reserva'
    ];
}