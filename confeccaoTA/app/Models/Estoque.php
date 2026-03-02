<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoques';

    protected $fillable = [
        'produto',
        'codigo',
        'quantidade',
        'preco',
        'tamanho',
        'cor'
    ];
}