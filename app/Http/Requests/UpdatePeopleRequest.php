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
        return false;
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
            'nome' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:peoples,email,' . $peopleId,
            'cpf' => 'sometimes|string|unique:peoples,cpf,' . $peopleId . '|max:14',
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'sometimes|date',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.email' => 'Informe um email válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'cpf.max' => 'O CPF não pode ter mais de 14 caracteres.',
            'data_nascimento.date' => 'Informe uma data válida.',
        ];
    }
}
