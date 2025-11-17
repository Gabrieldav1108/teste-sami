<?php

namespace App\Http\Requests;

use App\Rules\CpfValidation;
use App\Rules\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePeopleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        $peopleId = $this->route('people');
        $people = \App\Models\People::find($peopleId);

        return [
            'nome' => 'sometimes|string|max:255|min:3',
            'email' => [
                'sometimes',
                'email',
                function ($attribute, $value, $fail) use ($people) {
                    if ($people && $value !== $people->email) {
                        $exists = \App\Models\People::where('email', $value)
                            ->where('id', '!=', $people->id)
                            ->exists();
                        if ($exists) {
                            $fail('Este email já está cadastrado.');
                        }
                    }
                },
            ],
            'cpf' => [
                'sometimes',
                function ($attribute, $value, $fail) use ($people) {
                    if ($people) {
                        $cleanValue = preg_replace('/\D/', '', $value);
                        $cleanCurrent = preg_replace('/\D/', '', $people->cpf);
                        
                        // Se o CPF for diferente do atual, verifica se já existe
                        if ($cleanValue !== $cleanCurrent) {
                            $exists = \App\Models\People::where('cpf', $cleanValue)
                                ->where('id', '!=', $people->id)
                                ->exists();
                            if ($exists) {
                                $fail('Este CPF já está cadastrado.');
                            }
                        }
                    }
                },
                new CpfValidation(fieldDescription: 'O CPF'),
            ],
            'telefone' => [
                'sometimes',
                new PhoneValidation(fieldDescription: 'O telefone'),
            ],
            'data_nascimento' => [
                'sometimes', 
                'date', 
                'before_or_equal:now',
                'after_or_equal:' . now()->subYears(120)->format('Y-m-d')
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'email.email' => 'Informe um email válido.',
            'data_nascimento.date' => 'Informe uma data válida.',
            'data_nascimento.before_or_equal' => 'A data de nascimento não pode ser no futuro.',
            'data_nascimento.after_or_equal' => 'A data de nascimento não pode ser anterior a 120 anos atrás.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        if ($this->has('cpf')) {
            $this->merge([
                'cpf' => preg_replace('/\D/', '', $this->cpf),
            ]);
        }
        
        if ($this->has('telefone')) {
            $this->merge([
                'telefone' => preg_replace('/\D/', '', $this->telefone),
            ]);
        }
    }
}