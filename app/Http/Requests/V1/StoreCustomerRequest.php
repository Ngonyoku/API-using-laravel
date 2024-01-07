<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['required'],
            'type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
            'email' => ['required', 'email'],
            'city' => ['required'],
            'address' => ['required'],
            'state' => ['required'],
            'postalCode' => ['required'],
        ];
    }

    # Will get the postalCode value to the postal_code field in the database after validation
    protected function prepareForValidation() {
        $this->merge(['postal_code' => $this->postalCode]);
    }
}
