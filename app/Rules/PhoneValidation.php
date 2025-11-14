<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneValidation implements ValidationRule
{
    public function __construct(
        public bool $implicit = false,
        private string $field_description = ':attribute'
    ) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            if ($this->implicit) {
                $fail(__(':field_description é obrigatório.', ['field_description' => $this->field_description]));
                return;
            }
            return;
        }
        
        if (preg_match('/^\(?[1-9]{2}\)?\s?(?:9?[2-9][0-9]{3})-?[0-9]{4}$/', $value) !== 1) {
            $fail(__(':field_description não possui um formato válido.', ['field_description' => $this->field_description]));
        }
    }
}