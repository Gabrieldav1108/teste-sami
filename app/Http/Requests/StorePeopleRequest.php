<?php

namespace App\Http\Requests;

use App\Rules\CpfValidation;
use App\Rules\PhoneValidation;
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
            'cpf' => [
                'required',
                'string',
                'unique:peoples,cpf',
                'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
                new CpfValidation(),
            ],
            'telefone' => [
                'required',
                'string',
                'max:20',
                'regex:/^\(\d{2}\)\s?\d{4,5}\-\d{4}$/',
                new PhoneValidation(),
            ],
            'data_nascimento' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Informe um email válido.',
            'email.unique' => 'Este email já está cadastrado.',

            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'cpf.regex' => 'O CPF deve estar no formato 000.000.000-00.',

            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.regex' => 'O formato do telefone é inválido.',

            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'data_nascimento.date' => 'Informe uma data válida.',
        ];
    }

}
