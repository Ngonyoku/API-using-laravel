<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
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
        # Expects an array of objects with the following properties [{'customerId':'',..},..]
        # customerId, status, billedDate, paidDate, amount
        return [
            '*.customerId' => ['required', 'integer'], // Must be int value
            '*.amount' => ['required', 'numeric'], // Must be numeric value
            '*.status' => ['required', Rule::in(['P', 'B', 'V', 'p', 'b', 'v'])], // Must contain the following rules
            '*.billedDate' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.paidDate' => ['date_format:Y-m-d H:i:s', 'nullable'], //Is not required/ Can be null
        ];
    }

    protected function prepareForValidation() {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['billed_date'] = $obj['billedDate'] ?? null;
            $obj['paid_date'] = $obj['paidDate'] ?? null;

            $data[] = $obj;
        }

        $this->merge($data); // Merge the new data
    }
}
