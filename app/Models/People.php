<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //Defining the table name
    protected $table = 'peoples';

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'email',
        'telefone'
    ];

}
