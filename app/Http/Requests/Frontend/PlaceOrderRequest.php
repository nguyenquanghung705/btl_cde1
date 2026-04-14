<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'customer_email' => ['required', 'email', 'max:150'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'payment_method' => ['required', 'in:cod,vnpay,momo,bank_transfer'],
            'note' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Vui lòng nhập họ tên.',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại.',
            'customer_phone.regex' => 'Số điện thoại không hợp lệ.',
            'customer_email.required' => 'Vui lòng nhập email.',
            'customer_email.email' => 'Email không hợp lệ.',
            'shipping_address.required' => 'Vui lòng nhập địa chỉ giao hàng.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
        ];
    }
}
