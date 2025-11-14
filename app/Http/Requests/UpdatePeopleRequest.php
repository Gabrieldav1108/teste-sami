<?php

namespace App\Http\Requests;

use App\Rules\CpfValidation;
use App\Rules\PhoneValidation;
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
                'unique:peoples,cpf,' . $peopleId,
                new CpfValidation(fieldDescription: 'O CPF'),
            ],
            'telefone' => [
                'sometimes',
                new  PhoneValidation(fieldDescription: 'O telefone'),
            ],
            'data_nascimento' => 'sometimes|date|before_or_equal:now',
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

            'data_nascimento.date' => 'Informe uma data válida.',
            'data_nascimento.before_or_equal' => 'A data de nascimento não pode ser no futuro.',
        ];
    }

}
