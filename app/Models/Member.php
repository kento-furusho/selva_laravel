<?php

namespace App\Models;

use App\Mail\ResetPassMail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{

    use Notifiable;

    protected $rememberTokenName = false;

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
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

}
