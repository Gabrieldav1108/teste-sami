<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeopleFactory extends Factory
{
    protected $model = People::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->generateCpf(),
            'telefone' => $this->faker->numerify('###########'), 
            'data_nascimento' => $this->faker->date(),
        ];
    }

    /**
     * Generate a valid CPF number.
     *
     * @return string
     */

    private function generateCpf(): string
    {
        $cpf = '';
        for ($i = 0; $i < 9; $i++) {
            $cpf .= mt_rand(0, 9);
        }

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (10 - $i);
        }
        $digit1 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);
        $cpf .= $digit1;

        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += $cpf[$i] * (11 - $i);
        }
        $digit2 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);
        $cpf .= $digit2;

        return $cpf;
    }
}