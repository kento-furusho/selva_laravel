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
    public function scopeSearch($query, $category_id, $subcategory_id, $free_word)
    {
        return $query->when(isset($category_id), function($q)use($category_id) {
                return $q->where('product_category_id', $category_id);
            })
            ->when(isset($subcategory_id), function($q)use($subcategory_id){
                return $q->where('product_subcategory_id', $subcategory_id);
            })
            ->when(isset($free_word), function($q)use($free_word){
                $pat = '%' . addcslashes($free_word, '%_\\') . '%';
                return $q->where('name', 'LIKE', $pat)->orWhere('product_content', 'LIKE', $pat);
            });
    }

}
