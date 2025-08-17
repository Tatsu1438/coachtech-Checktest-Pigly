<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Step2Request extends FormRequest
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
            "current-weight"=>'required|string|max:4|regex:/^\d{1,3}(\.\d)?$/',
            "goal-weight"=>'required|string|max:4|regex:/^\d{1,3}(\.\d)?$/',
        ];
    }

    public function messages(): array
    {
        return [
            "current-weight.required"=>'現在の体重を入力してください',
            "current-weight.max"=>'4桁までの数字で入力してください',
            'current-weight.regex' => '小数点がある場合は1桁まで入力してください',
            "goal-weight"=>'目標の体重を入力してください',
            "goal-weight.max"=>'4桁までの数字で入力してください',
            'goal-weight.regex' => '小数点がある場合は1桁までで入力してください',
        ];
    }
}
