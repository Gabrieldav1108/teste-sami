<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfValidation implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = preg_replace('/\D/', '', $value);
        
        if (!$this->validateCpf($cpf)) {
            $fail('O CPF informado é inválido.');
        }
    }

    /**
     * Validate CPF number.
     * @param string $cpf
     * @return bool
     */

    private function validateCpf(string $cpf): bool
    {
        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/^(0{11}|1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11})$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;

            if ($cpf[$t] != $d) {
                return false;
            }
        }

        return true;
    }
}