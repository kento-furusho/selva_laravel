<?php

namespace App\Models;

use App\Mail\ResetPassMail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;

// memberテーブルに紐づけてくれる
class Member extends Model
{


    protected $fillable = [
        'name_sei',
        'name_mei',
        'nickname',
        'gender',
        'password',
        'email'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
