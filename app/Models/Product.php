<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'member_id',
        'product_category_id',
        'product_subcategory_id',
        'name',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'product_content'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
