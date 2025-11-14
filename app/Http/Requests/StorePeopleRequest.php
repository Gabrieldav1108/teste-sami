<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeopleRequest extends FormRequest
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
        
        return [
            'nome' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:peoples,email',
            'cpf' => 'required|string|unique:peoples,cpf|max:14|min:11',
            'telefone' => 'required|string|max:20|min:9',
            'data_nascimento' => 'required|date|before_or_equal:now',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 120 caracteres.',
            'nome.min' => 'O nome não pode ter menos de 3 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Informe um email válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'cpf.max' => 'O CPF não pode ter mais de 14 caracteres.',
            'cpf.min' => 'O CPF não pode ter menos de 11 caracteres.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'telefone.min' => 'O telefone não pode ter menos de 9 caracteres.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'data_nascimento.date' => 'Informe uma data válida.',
            'data_nascimento.before_or_equal' => 'A data de nascimento não pode ser uma data futura.',
        ];
    }
}
