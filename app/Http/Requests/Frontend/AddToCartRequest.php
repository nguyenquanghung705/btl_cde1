<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
        ];
    }

    public function quantity(): int
    {
        return max(1, (int) $this->input('quantity', 1));
    }
}
