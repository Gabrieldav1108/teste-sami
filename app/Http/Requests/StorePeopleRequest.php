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
                'unique:peoples,cpf',
                new CpfValidation(implicit: true, fieldDescription: 'O CPF'),
            ],
            'telefone' => [
                'required',
                new  PhoneValidation(implicit: true, fieldDescription: 'O telefone'),
            ],
            'data_nascimento' => ['
                sometimes', 
                'date', 
                'before_or_equal:now',
                'after_or_equal:' . now()->subYears(120)->format('Y-m-d')
            ],
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

            'telefone.required' => 'O campo telefone é obrigatório.',

            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'data_nascimento.date' => 'Informe uma data válida.',
            'data_nascimento.before_or_equal' => 'A data de nascimento não pode ser no futuro.',
            'data_nascimento.after_or_equal' => 'A data de nascimento não pode ser anterior a 120 anos atrás.',
        ];
    }

}
