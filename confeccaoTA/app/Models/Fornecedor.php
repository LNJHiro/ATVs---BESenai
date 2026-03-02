<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores'; // define o nome correto da tabela

    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'email',
        'endereco',
        'contato',
        'observacao'
    ];
}