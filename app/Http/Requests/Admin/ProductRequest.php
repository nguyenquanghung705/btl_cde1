<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:200'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'model' => ['nullable', 'string', 'max:100'],
            'cpu' => ['nullable', 'string', 'max:100'],
            'ram' => ['nullable', 'string', 'max:50'],
            'storage' => ['nullable', 'string', 'max:100'],
            'gpu' => ['nullable', 'string', 'max:100'],
            'screen' => ['nullable', 'string', 'max:100'],
            'os' => ['nullable', 'string', 'max:50'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'battery' => ['nullable', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'stock' => ['required', 'integer', 'min:0'],
            'warranty' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'is_new' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'sale_price.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'brand_id.exists' => 'Hãng không tồn tại.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_new' => $this->boolean('is_new'),
            'status' => $this->has('status') ? $this->boolean('status') : 1,
        ]);
    }
}
