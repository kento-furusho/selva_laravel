<?php

namespace App\Models;

use App\Mail\ResetPassMail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{

    use Notifiable;
    use SoftDeletes;

    protected $rememberTokenName = false;

    protected $fillable = [
        'name_sei',
        'name_mei',
        'nickname',
        'gender',
        'password',
        'email',
        'deleted_at'
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
    public function scopeSearch($query, $id, $man, $woman, $free_word)
    {
            // ddd($man);
            $query->when(isset($id), function($q)use($id) {
                return $q->where('id', $id);
            });
            $query->when(!empty($man) || !empty($woman), function($q)use($man, $woman){
                return $q->where(function($q)use($man,$woman){
                    return $q->where('gender', $man)->orWhere('gender', $woman);
                });
            });
            $query->when(isset($free_word), function($q)use($free_word){
                // return $q->where('name_sei', 'LIKE', $pat)->orWhere('name_mei', 'LIKE', $pat)->orWhere('email', 'LIKE', $pat);
                return $q->where(function($q)use($free_word){
                    $pat = '%' . addcslashes($free_word, '%_\\') . '%';
                    $q->where('name_sei', 'LIKE', $pat)->orWhere('name_mei', 'LIKE', $pat)->orWhere('email', 'LIKE', $pat);
                });
            });
    }

}
