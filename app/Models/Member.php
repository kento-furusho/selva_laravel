<?php

namespace App\Models;
// namespace Illuminate\Foundation\Auth;

use App\Mail\ResetPassMail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;

// memberテーブルに紐づけてくれる
class Member extends Model
{
    use CanResetPassword;

    protected $fillable = [
        'name_sei',
        'name_mei',
        'nickname',
        'gender',
        'password',
        'email'
    ];

}
