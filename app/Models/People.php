<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    
    //Defining the table name
    protected $table = 'peoples';

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'email',
        'telefone'
    ];


    public function getBirthDateFormattedAttribute()
    {
        return Carbon::parse($this->attributes['data_nascimento'])->format('d/m/Y');
    }

    public function getCpfFormattedAttribute()
    {
        $cpf = preg_replace('/\D/', '', $this->cpf);
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }

    public function getPhoneFormattedAttribute()
    {
        $phone = preg_replace('/\D/', '', $this->telefone);
        
        if (strlen($phone) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
        } else {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $phone);
        }
    }

}
