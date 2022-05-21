<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'login_id' => 'required|regex:/^[a-z0-9]{7,10}+$/',
            'password' => 'required|regex:/^[a-z0-9]{8,20}+$/'
        ];
    }
    public function messages()
    {
        return [
            'login_id.required' => '※ログインIDは必須です',
            'login_id.regex' => '※ログインIDは7~10文字の半角英数字が使用できます',
            'password.required' => '※パスワードは必須です',
            'password.regex' => '※パスワードは8~20文字の半角英数字が使用できます',
        ];
    }
}
