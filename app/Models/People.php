<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'email',
        'telefone'
    ];

}
