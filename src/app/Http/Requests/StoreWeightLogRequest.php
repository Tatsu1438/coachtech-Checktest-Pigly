<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;


class StoreWeightLogRequest extends FormRequest
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
            'date' => 'required|date',
            'weight' => 'required|numeric|regex:/^\d{1,3}(\.\d)?$/',
            'calories' => 'required|numeric',
            'exercise_time' => 'required|numeric',
            'exercise_content' => 'nullable|string|max:120',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $form = $this->route()->getName() === 'weight_logs.update' ? 'edit' : 'store';

        $response = redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('form', $form);

        throw new ValidationException($validator, $response);
    }

    public function messages()
    {
        return[
            'date.required'=>'日付を入力してください',
            'weight.required'=>'体重を入力してください',
            'weight.regex' => '小数点は1桁まで入力可能です',
            'calories.required'=>'摂取カロリーを入力してください',
            'calories.numeric'=>'数字で入力してください',
            'exercise_time.required'=>'運動時間を入力してください',
            'exercise_content.max'=>'120文字以内で入力してください',
        ];
    }
}
