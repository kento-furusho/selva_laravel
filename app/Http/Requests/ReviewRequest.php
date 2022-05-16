<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'evaluation' => 'required|integer|between:1,5',
            'comment' => 'required|max:500'
        ];
    }
    public function messages()
    {
        return [
            'evaluation.required' => '※商品評価は必須です',
            'evaluation.integer' => '※正しく選択してください',
            'evaluation.between' => '※正しく選択してください',
            'comment.required' => '※商品コメントは必須です',
            'comment.max' => '※商品コメントは500文字以内で入力したください',
        ];
    }
}
