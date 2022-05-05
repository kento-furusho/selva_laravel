<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
