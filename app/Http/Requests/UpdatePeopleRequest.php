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
            'cpf' => 'sometimes|string|unique:peoples,cpf,' . $peopleId . '|max:14|min:11',
            'telefone' => 'sometimes|string|max:20|min:9',
            'data_nascimento' => 'sometimes|date|before_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'nome.min' => 'O nome não pode ter menos de 3 caracteres.',
            'email.email' => 'Informe um email válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'cpf.max' => 'O CPF não pode ter mais de 14 caracteres.',
            'cpf.min' => 'O CPF não pode ter menos de 11 caracteres.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'telefone.min' => 'O telefone não pode ter menos de 9 caracteres.',
            'data_nascimento.date' => 'Informe uma data válida.',
            'data_nascimento.before_or_equal' => 'A data de nascimento não pode ser uma data futura.',
        ];
    }
}
