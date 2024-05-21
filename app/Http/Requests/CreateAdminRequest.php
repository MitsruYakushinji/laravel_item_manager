<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
            'name' => 'required|string|max:10',
            'department_id' => 'required|integer'
        ];
    }

    /**
     * バリデーション項目名定義
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '管理者名',
            'department_id' => '部署'
        ];
    }
}
