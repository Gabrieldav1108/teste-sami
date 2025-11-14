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
                new \App\Rules\CpfValidation(),
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

}
