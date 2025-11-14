<?php

namespace App\Models;

use Carbon\Carbon;
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


    public function getBirthDateFormatedAttribute()
    {
        return Carbon::parse($this->attributes['data_nascimento'])->format('d/m/Y');
    }

}
