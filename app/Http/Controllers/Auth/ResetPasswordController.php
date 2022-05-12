<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected function rules()
    {
            return [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|regex:/^[a-z0-9]{8,20}+$/',
            ];
    }
    protected function validationErrorMessages()
    {
            return [
                'password.required' => 'パスワードを入力してください',
                'password.regex' => 'パスワードは8~20文字の半角英数字が使用できます',
                'password.confirmed' => 'パスワードが一致しません',
            ];
    }
}
