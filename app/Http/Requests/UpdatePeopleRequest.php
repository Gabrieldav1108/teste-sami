<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePeopleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $peopleId = $this->route('people'); 

        return [
            'nome' => 'sometimes|string|max:255|min:3',
            'email' => 'sometimes|email|unique:peoples,email,' . $peopleId,
            'cpf' => [
                'sometimes',
                'string',
                'unique:peoples,cpf,' . $peopleId,
                'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
                function ($attribute, $value, $fail) {
                    $numericCpf = preg_replace('/\D/', '', $value);
                    if (! $this->validateCpf($numericCpf)) {
                        $fail('O CPF informado é inválido.');
                    }
                }
            ],
            'telefone' => [
                'sometimes',
                'string',
                'max:20',
                'regex:/^\(\d{2}\)\s?\d{4,5}\-\d{4}$/',
            ],
            'data_nascimento' => 'sometimes|date',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',

            'email.email' => 'Informe um email válido.',
            'email.unique' => 'Este email já está cadastrado.',

            'cpf.unique' => 'Este CPF já está cadastrado.',
            'cpf.regex' => 'O CPF deve estar no formato 000.000.000-00.',

            'telefone.regex' => 'O telefone informado é inválido.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            
            'data_nascimento.date' => 'Informe uma data válida.',
        ];
    }

    /**
     * Summary of validateCpf
     * @param mixed $cpf
     * @return bool
     */
    private function validateCpf($cpf): bool
    {
        $cpf = preg_replace('/\D/', '', $cpf);

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
