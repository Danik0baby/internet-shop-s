<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'comment' => ['nullable', 'string', 'max:1000'],
            'delivery_method' => ['required', Rule::in(['courier', 'pickup'])],
            'payment_method' => ['required', Rule::in(['cash', 'card'])],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'customer_name.required' => 'Укажите имя получателя.',
            'email.required' => 'Укажите электронную почту.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'phone.required' => 'Укажите телефон для связи.',
            'city.required' => 'Укажите город.',
            'address.required' => 'Укажите адрес доставки.',
            'delivery_method.required' => 'Выберите способ доставки.',
            'delivery_method.in' => 'Выберите корректный способ доставки.',
            'payment_method.required' => 'Выберите способ оплаты.',
            'payment_method.in' => 'Выберите корректный способ оплаты.',
        ];
    }

    /**
     * Get custom attribute names.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'customer_name' => 'имя получателя',
            'email' => 'электронная почта',
            'phone' => 'телефон',
            'city' => 'город',
            'address' => 'адрес',
            'comment' => 'комментарий',
            'delivery_method' => 'способ доставки',
            'payment_method' => 'способ оплаты',
        ];
    }
}
