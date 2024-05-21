<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditStockRequest extends FormRequest
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
            'stock.*' => 'required|integer|min:1'
        ];
    }

    /**
     * バリデーション項目名定義
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'stock.*' => '入出荷数',
        ];
    }

    public function messages(): array
    {
        return [
            'stock.*.required' => '入出荷数は必須項目です。',
            'stock.*.integer' => '入出荷数は整数である必要があります。',
            'stock.*.min' => '入出荷数は1以上である必要があります。',
        ];
    }

}
